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
 * @package Playpen
 */
class RomanNumerals
{
    /**
     * Map for number lookup. This requires PHP 5.6
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
        '0.91' => 'S.....',
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
        '0.04' => 'T', // T as Tiny though its not standard letter in duo decimal system
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
        // At first thought I was thinking to convert the decimal just like integer something like
        // 2.5 => II.V
        // But the problem with this approach is the zeros.
        // For example we cannot say 2.500 = II.D (which would be incorrect)
        // Since we are already using character map I think using duo decimal scheme is more appropriate here. In that way
        // we do not have to change anything and just use the map.

        $result = '';

        foreach (self::LOOKUP_MAP as $key => $value) {

            while ($input >= $key) {

                $result .= $value;
                $input = $input - $key;
            }
        }

        return $result;
    }

    /**
     *
     *
     * @param mixed $input
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