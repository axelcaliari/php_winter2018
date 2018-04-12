<?php

class FizzBuzz
{
    public function curryIsDivisible($divider, $returnString)
    {
        // This line allows us to avoid the division by zero error.
        $divider = $divider !== 0 ? $divider : 1;
        return function ($item) use ($divider, $returnString) {
            return !is_string($item) && $item % $divider === 0 ? $returnString : $item;
        };
    }

    public function process(array $array)
    {
        // Functional programming style
        $isDivisibleBy3Fizz = $this->curryIsDivisible(3, 'Fizz');
        $isDivisibleBy5Buzz = $this->curryIsDivisible(5, 'Buzz');
        $isDivisibleBy15FizzBuzz = $this->curryIsDivisible(15, 'FizzBuzz');

        return array_map(
            $isDivisibleBy3Fizz,
            array_map(
                $isDivisibleBy5Buzz,
                array_map(
                    $isDivisibleBy15FizzBuzz,
                    $array
                )
            )
        );

        // Imperative programming style
        /*foreach ($array as $key => &$item) {
            if ($item % 15 === 0) {
                $item = 'FizzBuzz';
            } elseif ($item % 5 === 0) {
                $item = 'Buzz';
            } elseif ($item % 3 === 0) {
                $item = 'Fizz';
            }
        }
        return $array;*/
    }
}
