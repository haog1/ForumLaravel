<?php

namespace App\Filters;


use App\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{

    protected $filters = ['by','popular'];

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


    /**
     * query all array elem and return from highest replies thread
     * @return mixed
     */
    protected function popular()
    {

        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count','desc');
    }
}