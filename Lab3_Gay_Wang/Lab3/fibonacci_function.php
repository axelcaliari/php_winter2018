<?php

function Fibonacci(int $n = 0)
{
    $j = 0;
    $k = 1;
    for($i = 0; $i < $n; $i++) {
        $temp = $j + $k;
        $j = $k;
        $k = $temp;
    }
    return $j;
}
echo Fibonacci(10).PHP_EOL;

/*
 * Please declare/define and use a Fibonacci function that has one optional parameter to determine
 * the number of numbers to be included in the Fibonacci sequence.
 */