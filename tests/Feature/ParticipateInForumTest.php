<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    function unauth_user_cannot_add_reply()
    {
        $this->withExceptionHandling()
             ->post('/threads/somechannel/1/replies',[])->assertRedirect('/login');
    }

    /**
     * @test
     */
    function an_authenticated_user_can_participate_in_forum_thread()
    {
        /* given an existing thread and a user
         * user can comment
         * the comment should be visible after submitting
         */
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);

    }

    /**
     * @test
     */
    function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }


}
