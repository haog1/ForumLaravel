<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    use favoritable, RecordsActivity;

    protected $guarded = [];
    protected $with = ['owner','favorites','thread']; // query reduction
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

}
