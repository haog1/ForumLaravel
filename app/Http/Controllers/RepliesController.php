<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Inspections\Spam;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @param Spam $spam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channelId, Thread $thread, Spam $spam)
    {
        $this->validate(request(), ['body' => 'required']);

        $spam->detect(request('body'));

        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        if (request()->expectsJson()) {
            return $reply->load('owner');
        }

        return back()->with('flash', 'Your reply has been left.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $replies
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $replies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $replies
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $replies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $replies
     * @return \Illuminate\Http\Response
     */
    public function update(Reply $reply, Spam $spam)
    {
        $this->authorize('update', $reply);

        $this->validate(request(), ['body' => 'required']);
        $spam->detect(request('body'));

        $reply->update(['body' => request('body') ]);
    }

    /**
     * Remove the specified resource from storage.
     *w
     * @param  \App\Reply  $replies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {

        $this->authorize('update', $reply);

        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }

        return back();

    }
}
