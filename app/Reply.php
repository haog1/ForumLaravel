<?php

namespace App;

use function foo\func;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    use favoritable, RecordsActivity;

    protected $guarded = [];
    protected $with = ['owner','favorites','thread']; // query reduction
    protected $appends = ['favoritesCount','isFavorited'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($reply) {
            $reply->favorites->each->delete();
        });


        static::created(function ($reply){
            $reply->thread->increment('replies_count');
        });

        static::deleted(function ($reply){
            $reply->thread->decrement('replies_count');
        });
    }

    /**
     * set up reply owner
     */
    public function owner()
    {

        return $this->belongsTo(User::class,'user_id');

    }

    /**
     * A reply belongs to a thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path(){
        return $this->thread->path() . "#reply-" . $this->id;
    }


}
