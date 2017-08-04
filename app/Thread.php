<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected $guarded = [];


    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
//        return '/threads/'.$this->id;
        return "/threads/{$this->channel->slug}/{$this->id}";
        //return "/threads/{$this->channel->slug}/{$this->id}";
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
        $this->replies()->create($reply);
    }


}
