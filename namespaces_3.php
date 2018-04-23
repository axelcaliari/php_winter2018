<?php

namespace X
{

    use Y\Z, S\T, \Q;

    $a = new Q();
    $b = new T();
    $c = new Z();

    var_dump($a, $b, $c);

}

namespace
{

    class Q
    {
        public $a = 1;
    }

}

namespace S
{

    class T
    {
        public $b = 2;
    }

}

namespace Y
{

    class Z
    {
        public $c = 3;
    }

}