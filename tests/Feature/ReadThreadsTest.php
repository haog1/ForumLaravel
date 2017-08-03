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
        $this->get('/threads/' . $this->thread->id)->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_replies_that_are_associate_with_a_thread()
    {

        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        // given a thread with some replies,
        $this->get('/threads/'.$this->thread->id)->assertSee($reply->body);
        // when we visit the thread page,
        // then we should see the replies
    }

}
