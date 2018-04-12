<?php

/*
 * Please declare/define and use a Fibonacci function that has one optional parameter to determine
 * the number of numbers to be included in the Fibonacci sequence.
 */

function fibonacci($i = 7)
{
    if ($i < 1) {
        return 0;
    } else if ($i == 1)
    {
        return 1;
    }else
    {
        return (fibonacci($i - 1) + fibonacci($i - 2));
    }
}

echo fibonacci(11);

