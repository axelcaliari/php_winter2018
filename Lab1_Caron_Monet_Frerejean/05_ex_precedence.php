<?php

echo"10" + "0.6", 44 . 1 . PHP_EOL;

/*
 * Return value is: 10.6441
 *
 * Please explain:
 *
 * Since it's "10" + "0.6", there is type juggling for 10 and 0.6 (Thus it is converted into floats) and the operation will occur with these numbers.
 * 44 is added after the 10.6 and with the "." the program concatenate 1 to this number which result to 10.6441
 *
 * The comma separates echo's parameters and acts as a concatenation operator in this context.
 */