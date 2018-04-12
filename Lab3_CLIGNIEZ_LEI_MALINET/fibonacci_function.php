<?php

/*
 * Please declare/define and use a Fibonacci function that has one optional parameter to determine
 * the number of numbers to be included in the Fibonacci sequence.
 */

function fibonacci($number = 10)
{
    $table = [];
    $table[] = 1;
    $table[] = 1;
    for ($i = 2; $i < $number; $i++)
    {
        $table[] = $table[$i-2] + $table[$i-1];
    }
    return $table;
}

var_dump( fibonacci(20) );