<?php

/*
 * Please declare/define and use a Fibonacci function that has one optional parameter to determine
 * the number of numbers to be included in the Fibonacci sequence.
 */



function Fibo(int $n = 5){
    $a = 0;
    $b = 1;
    for($i = 2; $i< ($n); $i++){

        $c = $b;
        $b = $a + $b;
        $a = $c;

    }
    echo $b;

}

Fibo(7);

