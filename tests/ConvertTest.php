<?php

use Playpen\Convert;

/**
 * AsciiToIntTest.php
 *
 * @author Nirmal <nirmalp@hotmail.com>
 */
class ConvertTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_convert_string_to_integer()
    {
        // We will use assert same here since it checks for value and type.
        $this->assertSame(2, Convert::atoi('2'));
        $this->assertSame(0, Convert::atoi('0'));
        $this->assertSame(500, Convert::atoi('500'));
        $this->assertSame(1000, Convert::atoi('1000'));
        $this->assertSame(1, Convert::atoi('00001'));
    }

    /**
     * @test
     */
    public function can_convert_string_to_integer_with_negative_symbol()
    {
        $this->assertSame(-2, Convert::atoi('-2'));
        $this->assertSame(-5000, Convert::atoi('-5000'));
    }

    /**
     * @test
     * @dataProvider getInvalidInputs
     * @param string $input
     */
    public function throws_exception_if_invalid_value_is_given($input)
    {
        $this->expectException(\InvalidArgumentException::class);

        $message = (empty($input)) ? 'Parameter given is not a valid parameter' : 'Parameter given is not a valid parameter ' . $input;
        $this->expectExceptionMessage($message);

        Convert::atoi($input);
    }

    /**
     * @return array
     */
    public function getInvalidInputs()
    {
        return [
            'with empty string'     => [''],
            'with null values'      => [null],
            'with invalid in front' => ['!2345'],
            'with decimal'          => ['23450.23']
        ];
    }
}
