<?php

namespace Tests\Feature;

use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotificationsTest extends TestCase
{

    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();

        $this->signIn();

    }

    /** @test */
    function a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply_that_is_not_by_the_current_user()
    {
        $thread = create('App\Thread')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        // should have no notification when it is replied by the author.
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'new reply'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        // should have one notification when replied by others.
        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'new reply'
        ]);
        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }


    /** @test */
    function a_user_can_fetch_unread_notifications()
    {
        create(DatabaseNotification::class);

        $this->assertCount(1, $this->getJson("/profile/" . auth()->user()->name . "/notifications")->json());
    }
    
    
    /** @test */
    function a_user_can_read_off_a_notification()
    {
        create(DatabaseNotification::class);

        $this->assertCount(1, auth()->user()->unreadNotifications); // checks read_at col in database
        
        $this->delete("/profile/" . auth()->user()->name . "/notifications/" . auth()->user()->unreadNotifications->first()->id);

        $this->assertCount(0, auth()->user()->fresh()->unreadNotifications);

    }

}
