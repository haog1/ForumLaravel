<?php

/**
 *  for testing combined functions
 */


/**
 * @param $class
 * @param array $attributes
 * @return mixed
 */
function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}


/**
 * @param $class
 * @param array $attributes
 * @return mixed
 */
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}