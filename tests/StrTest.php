<?php

use Playpen\Str;

/**
 * StrTest.php
 *
 * @author Nirmal <nirmalp@hotmail.com>
 */
class StrTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function checks_if_string_is_palindrome_without_ignoring_the_case()
    {
        $this->assertFalse(Str::isPalindrome('leveL', true));
        $this->assertTrue(Str::isPalindrome('level', true));
    }

    /**
     * @test
     */
    public function checks_if_string_is_palindrome_ignoring_the_case()
    {
        $this->assertFalse(Str::isPalindrome('tomorrow'));
        $this->assertTrue(Str::isPalindrome('leveL'));
        $this->assertTrue(Str::isPalindrome('ll'));
        $this->assertTrue(Str::isPalindrome('22'));
        $this->assertTrue(Str::isPalindrome('loooooool'));
    }

    /**
     * @test
     */
    public function returns_false_for_falsy_value()
    {
        $this->assertFalse(Str::isPalindrome(false));
        $this->assertFalse(Str::isPalindrome(null));
        $this->assertFalse(Str::isPalindrome(true));
    }

    /**
     * @test
     */
    public function checks_for_special_characters()
    {
        $this->assertFalse(Str::isPalindrome('Éle'));
        $this->assertTrue(Str::isPalindrome('Éleelé'));
        $this->assertTrue(Str::isPalindrome('lööl'));
        $this->assertFalse(Str::isPalindrome('Éleelé', true));
        $this->assertFalse(Str::isPalindrome('Héllöö'));
    }

    /**
     * @test
     * @dataProvider getInvalidInputs
     *
     * @param string $input
     */
    public function throws_exception_for_invalid_argument($input)
    {
        $this->assertFalse(Str::isPalindrome($input));
    }

    /**
     * @return array
     */
    public function getInvalidInputs()
    {
        return [
            'with empty string'     => [''],
            'with null values'      => [null],
            'with incorrect type'   => [true]
        ];
    }
}
