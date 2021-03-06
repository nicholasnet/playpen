<?php
/**
 * RomanNumerals.php
 *
 * @author Nirmal <nirmalp@hotmail.com>
 */

namespace Playpen;

/**
 * Class RomanNumerals
 *
 * Since this class does not need any states nor it mutates any state and does not to be passed to other class and does
 * not need to implement any interface. Hence all methods inside the class are static.
 *
 * @package Playpen
 */
class RomanNumerals
{
    /**
     * Map for roman number lookup. This requires PHP 5.6 since array is not literal type to be used as constant
     * in PHP < 5.6
     */
    const LOOKUP_MAP = [
        1000   => 'M',
        900    => 'CM',
        500    => 'D',
        400    => 'CD',
        100    => 'C',
        90     => 'XC',
        50     => 'L',
        40     => 'XL',
        10     => 'X',
        9      => 'IX',
        5      => 'V',
        4      => 'IV',
        1      => 'I',
        '0.91' => 'S.....', // Adding more intervals so that we will have to loop less.
        '0.83' => 'S....',
        '0.75' => 'S...',
        '0.66' => 'S..',
        '0.58' => 'S.',
        '0.50' => 'S',
        '0.41' => '.....',
        '0.33' => '....',
        '0.25' => '...',
        '0.16' => '..',
        '0.08' => '.',
        '0.04' => 'T', // T as Tiny though its not standard letter in duo decimal system.
    ];

    /**
     * This method converts numeric digits to roman numerals. Furthermore, it converts decimals into roman numerals
     * representation using custom encoding since there is no standardized way to convert the decimals in roman numerals.
     *
     * @param integer|float $input
     *
     * @return string
     */
    public static function convert($input)
    {
        // First and foremost make sure that we have valid input.
        self::validateInput($input);

        // We all know converting whole number to roman numeral is predefined so that is not the issue.
        // However, converting decimals is different.
        //
        // At first thought I was thinking to convert the decimal just like integer something like
        // 2.5 => II.V
        // But the problem with this approach is the zeros.
        // For example we cannot say 2.500 = II.D (which would be incorrect)
        //
        // Another approach I was thinking is to use different encoding for number before decimal and after like
        // 2.1 = IIE Here E refers to 1 after decimal)
        // Advantage of this approach is the precision but it is very confusing to use 2 types of encoding for same
        // number.
        //
        // Since we are already using character map I think using duo decimal scheme is more appropriate here. In that
        // way we do not have to change anything and just use the map.
        $result = '';

        foreach (self::LOOKUP_MAP as $key => $value) {

            while ($input >= $key) {

                $result = $result . $value;
                $input = $input - $key;

            }
        }

        return $result;
    }

    /**
     * This method validates the input if input is not valid it will throw an exception. In order to be a valid input
     * it must be numeric and must be more than 0 and less than 5000.
     *
     * @param $input
     *
     * @throws \InvalidArgumentException
     * @throws \OutOfRangeException
     */
    private static function validateInput($input)
    {
        if (false === is_numeric($input)) {

            throw new \InvalidArgumentException('Input given is invalid #' . $input);

        }

        if (($input <= 0) || ($input >= 5000)) {

            throw new \OutOfRangeException('Input given is invalid #' . $input);

        }
    }
}