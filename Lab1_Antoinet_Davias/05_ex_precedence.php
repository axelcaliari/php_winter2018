<?php

echo "10" + "0.6", 44 . 1 . PHP_EOL;

/*
 * Return value is:
 * 10.6441
 * Please explain:
 * 10 + 0.6 is equal to 10.6
 * 44 . 1 means that 44 and 1 are concatenated (see the '.' operator). Thus, we have 441.
 * In the end, everything is concatenated, like: '10.6' . '441' --> 10.6441
 * The comma separates echo's parameters and acts as a concatenation operator in this context.
 */