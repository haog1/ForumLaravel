<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{

    use DatabaseMigrations;
    

    /**
     * @test
     */
    public function a_user_has_a_profile()
    {
        $user = create('App\User');
        $this->get("/profile/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    function profile_display_all_threads_created_by_the_associated_user()
    {

        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $this->get("/profile/" . auth()->user()->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

}