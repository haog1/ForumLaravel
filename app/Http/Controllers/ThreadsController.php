<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Thread;
use App\Channel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
//        $this->middleware('auth')->only(['store','create']);
    }

    /**
     * @param Channel $channel
     * @param ThreadFilters $filters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
//        $threads = $this->getThreads($channel, $filters);

        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()){
            return $threads;
        }

//        dd($threads->toSql());

        return view('threads.index',compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Spam $spam)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'

        ]);

        $spam->detect(request('title'));
        $spam->detect(request('body'));

        $thread = Thread::create(['user_id' => auth()->id(), 'channel_id' => request('channel_id'),
            'title' => request('title'), 'body'  => request('body')]);

        return redirect($thread->path())->with('flash','Your thread has been published.');
    }


    /**
     * @param $Channel
     * @param Thread $thread
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($Channel, Thread $thread)
    {

        if (auth()->check()) {
            auth()->user()->read($thread);
        }
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $threads
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $threads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $threads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $threads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $threads
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update',$thread); // uses of ThreadPolicy and associate policy and thread in AuthServiceProvider

        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/threads')->with('flash','Your thread has been deleted!');

    }

    /**
     * @param Channel $channel
     * @param ThreadFilters $filters
     * @return mixed
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        $threads = $threads->get();
        return $threads;
    }


}
