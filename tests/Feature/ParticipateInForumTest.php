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

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = factory('App\Thread')->create();
        //$user = factory('App\user')->create();
        $reply = factory('App\Reply')->create();
//        $this->post($thread->path().'/replies',$reply->toArray());
        $this->post('/threads/1/replies',[]);
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
        $this->be($user = factory('App\User')->create()); // set as currently logged in user

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->make();
        $this->post($thread->path().'/replies',$reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }

}
