<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    function guests_cannot_create_threads()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = factory('App\Thread')->make();

        $this->post('/threads',$thread->toArray());
    }


    /**
     * @test
     */
    function an_auth_user_can_create_new_forum_thread()
    {
        $this->actingAs(factory('App\User')->create());
        $thread = factory('App\Thread')->make();

        $this->post('/threads',$thread->toArray());

        $this->get($thread->path())->assertSee($thread->title)->assertSee($thread->body);

    }


}
