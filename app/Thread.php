<?php

namespace App;

use App\Notifications\ThreadWasUpdated;
use function foo\func;
use Illuminate\Database\Eloquent\Model;


class Thread extends Model
{

    use RecordsActivity;


    /**
     * Don't auto-apply mass assignment protection
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $with = ['creator','channel'];

    protected $appends = ['isSubscribedTo'];

    /**
     * Boot the model
     */
    protected static function boot()
    {

        parent::boot();

        static::deleting(function ($thread){
            $thread->replies->each->delete();
        });

    }


    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    /**
     * @return mixed
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @return mixed
     */
    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }


    /**
     * @param $reply
     * @return mixed
     */
    public function addReply($reply)
    {

        $reply = $this->replies()->create($reply);

        //notify all subscribers when there is a new reply added
        // an alternative way to write foreach loop
        $this->subscriptions
            ->filter(function ($sub) use ($reply) {
                return $sub->user_id != $reply->user_id;
            })->each->notify($reply);
//            ->each(function ($sub) use ($reply) {
//                $sub->user->notify(new ThreadWasUpdated($this, $reply));
//            });

        return $reply;
    }


    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }


    /**
     * A thread can be subscribed
     * @param null $userId
     * @return $this
     */
    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);

        return $this;

    }

    /**
     * A thread can be unsubscribed
     * @param null $userId
     */
    public function unsubscribe($userId =null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id() )
            ->delete();

    }


    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);

    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()->where('user_id', auth()->id())->exists();
    }

}
