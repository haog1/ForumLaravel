<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Thread $thread)
    {
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back(); // redirect to previous position
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
    public function update(Request $request, Reply $replies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $replies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $replies)
    {
        //
    }
}
