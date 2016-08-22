<?php

namespace Playpen;

/**
 * Class Convert
 *
 * @package Playpen
 *
 */
class Convert
{
    /**
     * This method converts string representation of a number to an integer.
     *
     * For example
     *     '3'  to 3
     *     '-3' to -3
     *
     * Constraints
     *      Cannot use typecasting.
     *      Cannot use builtin language functions.
     *      Cannot use explicit multiplication.
     *
     * Error handling
     *      Must throw an exception for invalid values.
     *          => abcd
     *          => 0.10
     *          => -1.10
     *          => !!!
     *
     * @param string $parameter Parameter to be converted
     *
     * @return int The converted integer value.
     */
    public static function atoi($parameter)
    {
        // First check if any valid parameter is given if not throw exception. Cannot use empty here.
        if (null === $parameter || '' === $parameter) {

            throw new \InvalidArgumentException('Parameter given is not a valid parameter');

        }

        // As we all know count of digit goes like one, ten, thousand, ten thousand and so forth.
        // So, in each step we will have to multiply the position by 10 and add the number. However before processing
        // anything we need to check if number have any negative value, if there is then we will simply negate the
        // result and return.
        // For example if input is '2'. Then we will multiply the position (0 in this case) by 10 and add the number (2)
        // In the process we will check for any invalid parameter if we have any then we will throw an exception.

        // We will assume that value is positive by default.
        $isNegative = false;
        $result = 0;

        // In strict mode this may throw notice so suppress it since we cannot use native isset function here.
        for ($position = 0; @$parameter[$position] !== ''; $position++) {

            if ( (0 === $position) && ('-' === $parameter[$position]) ) {

                $isNegative = true;

                continue;
            }

            if (false === self::isValidValue($parameter[$position])) {

                throw new \InvalidArgumentException('Parameter given is not a valid parameter ' . $parameter);

            }

            $result = self::multiplyNumberByTen($result);
            $result = $result + $parameter[$position];
        }

        // We will have have negate the number if it is negative value
        return (true === $isNegative) ? 0 - $result : $result;
    }

    /**
     * This method multiplies the given number by 10 without using explicit multiplication. Since we cannot use explicit
     * multiplication we will use bit shift left.
     * First we will bit shift left the value by 3 then add the given value twice.
     *
     * For example if the given value is 5 then (5 << 3) will give us 40 then will add input twice that is (5 + 5)
     *
     * @param int $numberToMultiply Number to multiply by 10.
     *
     * @return int
     */
    public static function multiplyNumberByTen($numberToMultiply)
    {
        return ($numberToMultiply << 3) + $numberToMultiply + $numberToMultiply;
    }

    /**
     * This method checks whether given value is a digit or not.
     *
     * @param string $value Value to be checked.
     *
     * @return bool
     */
    private static function isValidValue($value)
    {
        $validValues = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

        foreach ($validValues as $validValue) {

            if ($validValue === $value) {

                return true;

            }

        }

        return false;
    }
}
