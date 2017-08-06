<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();

    }


    /** @test */
    function a_user_can_view_all_threads()
    {
        $response = $this->get('/threads')->assertSee($this->thread->title);
    }


    /** @test */
    function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_replies_that_are_associate_with_a_thread()
    {

//        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        // given a thread with some replies,
        $this->get($this->thread->path())->assertSee($reply->body);
        // when we visit the thread page,
        // then we should see the replies
    }


    /**
     * @test
     */
    function a_user_can_filter_threads_according_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);

    }

    /** @test */
    function a_user_can_filter_thrads_by_any_username()
    {
        $this->signIn(create('App\User',['name' => 'IsabelleSenger']));

        $threadsByTG = create('App\Thread',['user_id' => auth()->id()]);
        $otherThread = create('App\Thread');

        $this->get('threads?by=IsabelleSenger')
            ->assertSee($threadsByTG->title)
            ->assertDontSee($otherThread->title);

    }



}
