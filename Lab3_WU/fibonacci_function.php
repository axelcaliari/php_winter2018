<?php

/*
 * Please declare/define and use a Fibonacci function that has one optional parameter to determine
 * the number of numbers to be included in the Fibonacci sequence.
 */

function fibonacci($num) {
    if ($num == 0 || $num == 1) {
        echo $num;
        return;
    }
    $fibonacci = array(0,1);
    for ($i = 2; $i < $num; ++$i)
        $fibonacci[$i] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
    print_r($fibonacci);
}

fibonacci(12);