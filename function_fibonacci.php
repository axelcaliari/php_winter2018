<?php

function fibonacciSequenceNumbers($numberOfNumbers)
{

    $fibNumber = 0;
    
    $fibNumberPrevious = NULL;
    
    for ($i = 1; $i <= $numberOfNumbers; $i++) {
    	
    	echo $fibNumber . PHP_EOL;
    	
    	if ($fibNumber === 0 && is_null($fibNumberPrevious)) {
    		$fibNumber = 1;
            $fibNumberPrevious = 0;
    	} else {
    		$fibNumber += $fibNumberPrevious;
    		$fibNumberPrevious = $fibNumber - $fibNumberPrevious;
    	}
            
    }
    
    return true;

}

fibonacciSequenceNumbers(10);