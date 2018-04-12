<?php

function fibonacciSequenceNumbers ($numberOfNumbers = 1)
{

    $fibNumber = 0;

    $fibNumberPrevious = NULL;

    for ($i = 1; $i <= $numberOfNumbers; $i++) {

        echo $fibNumber . PHP_EOL;

        if (is_null($fibNumberPrevious)) {
            $fibNumber = 1;
            $fibNumberPrevious = 0;
        } else {
            $nthFibNumber = $fibNumber;
            $fibNumber += $fibNumberPrevious;
            $fibNumberPrevious = $fibNumber - $fibNumberPrevious;
        }

    }

    if ($fibNumber === 0) {
        $nthFibNumber = 'nothing';
    }

    return $nthFibNumber;

}

$nthNumber = 10;

$nthFibNumber = fibonacciSequenceNumbers($nthNumber);

echo "The Fibonacci number that holds position number $nthNumber is $nthFibNumber." . PHP_EOL;