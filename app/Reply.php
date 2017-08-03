<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    /**
     * set up reply owner
     */
    public function owner()
    {

        return $this->belongsTo(User::class,'user_id');

    }

}
