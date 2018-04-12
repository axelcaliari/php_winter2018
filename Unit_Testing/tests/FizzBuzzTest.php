<?php

class FizzBuzzTest extends PHPUnit_Framework_TestCase
{
    private $fizzBuzzInstance;

    public function setUp()
    {
        parent::setUp();

        $this->fizzBuzzInstance = new \FizzBuzz();
    }

    public function tearDown()
    {
        $this->fizzBuzzInstance = null;

        parent::tearDown();
    }

    /**
     * Tests FizzBuzz::process()
     *
     * @since 1.0.0
     *
     * @param string containing the expected result
     * @param int containing the test value
     *
     * @dataProvider providerIfItIsDivisibleByThreeByFiveOrThreeAndFive
     */
    public function testIfItIsDivisibleByThreeByFiveOrThreeAndFive($expected, $testData)
    {
        $result = $this->fizzBuzzInstance->process([$testData]);
        $this->assertEquals([$expected], $result);
    }

    public function providerIfItIsDivisibleByThreeByFiveOrThreeAndFive()
    {
        return [
            ['Fizz', 6],
            ['Buzz', 10],
            ['FizzBuzz', 30]
        ];
    }

    /**
     * Tests FizzBuzz::process()
     *
     * @since 1.0.0
     *
     * @param string containing the expected result
     * @param int containing the test value
     *
     * @dataProvider providerIfProcessMethodWillWorkWithEntireArrayOfValuesFrom0To15
     */
    public function testIfProcessMethodWillWorkWithEntireArrayOfValuesFrom0To15($expected, $testData)
    {
        $result = $this->fizzBuzzInstance->process($testData);
        $this->assertEquals($expected, $result);
    }

    public function providerIfProcessMethodWillWorkWithEntireArrayOfValuesFrom0To15()
    {
        return [
            [
                [
                    'FizzBuzz',
                    1,
                    2,
                    'Fizz',
                    4,
                    'Buzz',
                    'Fizz',
                    7,
                    8,
                    'Fizz',
                    'Buzz',
                    11,
                    'Fizz',
                    13,
                    14,
                    'FizzBuzz'
                ],
                range(0, 15)
            ]
        ];
    }

    /**
     * Tests FizzBuzz::curryIsDivisible()
     *
     * The functional programming style allows us to test
     * the link between the divider and the replacement string.
     *
     * @since 1.0.0
     *
     * @param string containing the expected result
     * @param int containing the divider to use
     * @param string containing the string that will be returned
     * @param int containing the test value
     *
     * @dataProvider providerIfCurryIsDivisibleReturnsProperHigherOrderFunction
     */
    public function testIfCurryIsDivisibleReturnsProperHigherOrderFunction($expected, $divider, $returnString, $item)
    {
        $returnedCurryFunction = $this->fizzBuzzInstance->curryIsDivisible($divider, $returnString);

        $this->assertSame($expected, $returnedCurryFunction($item));
    }

    public function providerIfCurryIsDivisibleReturnsProperHigherOrderFunction()
    {
        return [
            ['FizzBuzz', 15, 'FizzBuzz', 15,],
            ['Whatever', 7, 'Whatever', 7,],
            ['DividerHasBeenReplacedWithOne', 0, 'DividerHasBeenReplacedWithOne', 3,],
        ];
    }
}
