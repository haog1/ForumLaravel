<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $guarded = [];
    protected $with = ['owner','favorites']; // query reduction
    /**
     * set up reply owner
     */
    public function owner()
    {

        return $this->belongsTo(User::class,'user_id');

    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class,'favorited');
    }

    /**
     * Favorite the current reply.
     *
     * @return Model
     */
    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];
        if (! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }


    public function isFavorited()
    {
        return !! $this->favorites->where('user_id',auth()->id())->count();
    }

}
