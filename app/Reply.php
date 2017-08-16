<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    use favoritable;

    protected $guarded = [];
    protected $with = ['owner','favorites']; // query reduction
    /**
     * set up reply owner
     */
    public function owner()
    {

        return $this->belongsTo(User::class,'user_id');

    }

}
