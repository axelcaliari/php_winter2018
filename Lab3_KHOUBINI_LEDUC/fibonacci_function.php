<?php

function fibo($length)
{
 $a = 0;
$b = 1;
$res = 0;
for ($i = 1; $i <= $length; $i++) {
  $res = $a + $b;
  $a = $b;
  $b = $res;
}
  echo $res;
}


fibo(5);
