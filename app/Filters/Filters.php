<?php

namespace App\Filters;


use function foo\func;
use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request, Builder
     */
    protected $request, $builder;

    protected $filters = [];

    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {

            if (method_exists($this, $filter)) {

                $this->$filter($value);

            }
        }

        return $this->builder;
    }

    public function getFilters()
    {
        return $this->request->intersect($this->filters);
    }

}