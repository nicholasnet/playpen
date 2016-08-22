<?php
/**
 * Str.php
 *
 * @author Nirmal <nirmalp@hotmail.com>
 */

namespace Playpen;

class Str
{
    /**
     * This method checks whether given string is palindrome or not with following constraints.
     *
     * Constraints
     *      Must use constant memory O(1)
     *      Accessing each character in the string only once.
     *
     * Limitations:
     *      This method only works for ASCII characters.
     *
     * @param string  $parameter     String to check whether it is palindrome or not.
     * @param bool    $caseSensitive Flag that tells whether to ignore case or not.
     *
     * @return bool True if the given string is palindrome else false.
     */
    public static function isPalindrome($parameter, $caseSensitive = false)
    {
        // In order for word to be palindrome it must satisfy following conditions.
        //     => The string reversed should be same as given string. Like level = reverse of level which is level as well.
        //     => Also letter of fist index must be equal to last index and each increment of index value from left side
        //        must be equal with each decrement of index value from the right side.
        //
        // In this function we will ignore case if $caseSensitive is true else not.

        // If no input is given or value given is boolean then nothing to check.
        if (empty($parameter) || ($parameter === true)) {

            return false;

        }

        $length = strlen($parameter);

        // If string is of single length then it is palindrome no need to check further.
        if ($length === 1) {

            return true;

        }

        $parameter = ($caseSensitive === false) ? strtolower($parameter) : $parameter; // Normalize the string if necessary.
        $startIndex = 0;
        $endIndex = $length - 1;

        while ($startIndex < $endIndex) {

            // Check if value of left index is equal to corresponding right index.
            if ($parameter[$startIndex] !== $parameter[$endIndex]) {

                return false;

            }

            $startIndex++;
            $endIndex--;
        }

        return true;
    }
}
