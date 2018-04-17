<?php

echo "10" + "0.6", 44 . 1 . PHP_EOL;

/*
 * Return value is: 10.6441
 *
 * Please explain: first the '"10" + "0.6"' expression casts the two strings into float value and
 * adds them together, then the float value 10.6 are casted into string to be printed to the screen.
 * The comma and the point cast the integers 44 and 1 into string then concatenate them with the string
 * "10.6". So the result "10.6441" is printed.
 *
 */