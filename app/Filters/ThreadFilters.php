<?php

namespace App\Filters;


use App\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{

    protected $filters = ['by'];

    /**
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        // if request('by'), then should filter by the given username
        // firstOrFail makes it unique

        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

}