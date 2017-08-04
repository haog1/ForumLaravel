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

        $thread = make('App\Thread');


        $this->post('/threads',$thread->toArray());
    }

    /**
     * @test
     */
    function guest_cannot_see_create_thread_page()
    {
        $this->withExceptionHandling()->get('/threads/create')->assertRedirect('/login');
    }


    /**
     * @test
     */
    function an_auth_user_can_create_new_forum_thread()
    {
//        $this->actingAs(create('App\User'));
        $this->signIn();
        $thread = make('App\Thread');

        $this->post('/threads',$thread->toArray());

        $this->get($thread->path())->assertSee($thread->title)->assertSee($thread->body);

    }


}
