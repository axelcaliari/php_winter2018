<?php

echo "10" + "0.6", 44 . 1 . PHP_EOL;

/*
 * Return value is: 10.644l. The juggling transforms the two string in int and make it be 10.6,
 * then we concatenate it to 44 and then to l.
 *
 * Please explain:
 *
 * The comma separates echo's parameters and acts as a concatenation operator in this context.
 *
 */