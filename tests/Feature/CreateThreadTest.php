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

        $this->withExceptionHandling();

        $this->post('/threads')
            ->assertRedirect('/login');
        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    function an_auth_user_can_create_new_forum_thread()
    {
        $this->signIn();

        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**
     * @test
     */
    function a_thread_requires_a_title()
    {

        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');

    }

    /**
     * @test
     */
    function a_thread_requires_a_body()
    {

        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');

    }

    /**
     * @test
     */
    function a_thread_requires_a_channelId()
    {

        factory('App\Channel',2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }


    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread',$overrides);

        return $this->post('/threads',$thread->toArray());
    }

}
