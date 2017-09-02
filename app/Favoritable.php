<?php
/**
 * Created by PhpStorm.
 * User: tg
 * Date: 16/8/17
 * Time: 9:25 PM
 */

namespace App;


trait Favoritable
{

    protected static function bootFavoritable()
    {
        if (!auth()->check()) {
            return;
        }
        static::deleting(function ($reply) {
            $reply->favorites->each->delete();
        });
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

    /**
     * Favorite the current reply.
     *
     * @return Model
     */
    public function unFavorite()
    {
        $ids = ['user_id' => auth()->id()];
        $this->favorites()->where($ids)->get()->each->delete();
    }


    public function isFavorited()
    {
        return !! $this->favorites->where('user_id',auth()->id())->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}