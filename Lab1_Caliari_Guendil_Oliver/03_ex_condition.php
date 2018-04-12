<?php

$valueA = 5;
$valueB = 3;

echo 'ValueA is greater than ValueB <br />' . PHP_EOL;
echo 'ValueA is equal to ValueB <br />' . PHP_EOL;

if($valueA > $valueB){
    echo "valueA > valueB";
} elseif ($valueA < $valueB){
    echo "valueA < valueB";
} else {
    echo "equals";
}

/*echo $valueA > $valueB . PHP_EOL;
echo ($valueA == $valueB);*/