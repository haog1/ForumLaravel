<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email',
    ];


    public function getRouteKeyName()
    {
        return 'name';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }

    /**
     * Get all activity for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }


    public function read($thread)
    {

        cache()->forever(
            $this->visitedThreadCacheKey($thread),Carbon\Carbon::now());
    }

    /**
     * @param $thread
     * @return string
     */
    public function visitedThreadCacheKey($thread)
    {
        return sprintf("uesrs.%s.visits.%s", $this->id, $thread->id);
    }
    
}
