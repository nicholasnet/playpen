<?php

use Playpen\RomanNumerals;

/**
 * RomanNumeralsTest.php
 *
 * @author Nirmal <nirmalp@hotmail.com>
 */
class RomanNumeralsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function converts_number_to_roman_numerals()
    {
        $this->assertEquals('I', RomanNumerals::convert(1));
        $this->assertEquals('III', RomanNumerals::convert(3));
        $this->assertEquals('IV', RomanNumerals::convert(4));
        $this->assertEquals('V', RomanNumerals::convert(5));
        $this->assertEquals('VI', RomanNumerals::convert(6));
        $this->assertEquals('IX', RomanNumerals::convert(9));
        $this->assertEquals('X', RomanNumerals::convert(10));
        $this->assertEquals('XX', RomanNumerals::convert(20));
        $this->assertEquals('XL', RomanNumerals::convert(40));
        $this->assertEquals('L', RomanNumerals::convert(50));
        $this->assertEquals('D', RomanNumerals::convert(500));

        // For decimals
        $this->assertEquals('IIS', RomanNumerals::convert(2.5));
        $this->assertEquals('IIS...', RomanNumerals::convert(2.75));
        $this->assertEquals('IIT', RomanNumerals::convert(2.05));
    }

    /**
     * @test
     */
    public function can_convert_large_number_less_than_5000()
    {
        $this->assertEquals('MMMMCMXC', RomanNumerals::convert(4990));
    }

    /**
     * @test
     */
    public function throws_exception_for_number_that_is_equal_to_or_larger_than_5000()
    {
        $this->expectException(\OutOfRangeException::class);
        RomanNumerals::convert(5000);
    }

    /**
     * @test
     */
    public function throws_exception_for_number_that_is_less_than_or_equal_to_zero()
    {
        $this->expectException(\OutOfRangeException::class);
        RomanNumerals::convert(-25);
    }

    /**
     * @test
     * @dataProvider getInvalidInputs
     *
     * @param string $input
     */
    public function throws_exception_for_invalid_argument($input)
    {
        $this->expectException(\InvalidArgumentException::class);
        RomanNumerals::convert($input);
    }

    /**
     * @return array
     */
    public function getInvalidInputs()
    {
        return [
            'with empty string'     => [''],
            'with null values'      => [null],
            'with incorrect type'   => [true],
            'with invalid string'   => ['sadasd'],
            'with invalid digits'   => ['25..36']
        ];
    }
}
