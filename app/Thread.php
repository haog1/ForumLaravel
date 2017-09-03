<?php

namespace App;

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

    /**
     * Boot the model
     */
    protected static function boot()
    {

        parent::boot();

        static::addGlobalScope('replyCount', function ($builder){
            $builder->withCount('replies');

        });

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
     */
    public function addReply($reply)
    {

        return $this->replies()->create($reply);
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

}
