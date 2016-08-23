<?php
/**
 * Ackermann.php
 *
 * @author Nirmal <nirmalp@hotmail.com>
 */

namespace Playpen;

/**
 * Class Ackermann which computes the Ackermann function using recursive and non-recursive method. Since Ackermann
 * function grows very fast user may experience time out or memory exhaust or simply get Infinity (INF) result with large
 * number.
 *
 * Since this class does not need any states nor it mutates any state and does not to be passed to other class and does
 * not need to implement any interface. Hence all methods inside the class are static.
 *
 * @package Playpen
 */
class Ackermann
{
    /**
     * This property stores the computed value so that we do not have to compute and function with same argument twice.
     *
     * @var array
     */
    protected static $resultCache = [];

    /**
     * This function computes Ackermann function recursively given m >= 0 and n >= 0.
     *
     * @param int $m
     * @param int $n
     *
     * @return int
     */
    public static function computeRecursively($m, $n)
    {
        // If we have calculated the function with this parameter already and have stored the value then return the value
        // from cache directly.
        if (isset(self::$resultCache[$m][$n])) {

            return self::$resultCache[$m][$n];

        }

        if ($m < 4) {

            self::$resultCache[$m][$n] = self::applyAckermannFormula($m, $n);

        } elseif ($n === 0) {

            self::$resultCache[$m][$n] = self::computeRecursively($m - 1, 1);

        } else {

            self::$resultCache[$m][$n] = self::computeRecursively($m - 1, self::computeRecursively($m, $n - 1));

        }

        return self::$resultCache[$m][$n];
    }

    /**
     * This function computes Ackermann function recursively given m >= 0 and n >= 0
     *
     * @param int $m
     * @param int $n
     *
     * @return int
     */
    public static function computeNonRecursively($m, $n)
    {
        // If we have calculated the function with this parameter already and have stored the value then return the value
        // from cache directly.
        if (isset(self::$resultCache[$m][$n])) {

            return self::$resultCache[$m][$n];

        }

        // For non-recursive option if we disregard all other predefined condition and just concentrate on else part of
        // recursive function we can see that in each iteration we return the same function for $m we decrease value by
        // 1 and then for $b we pass same function again with $b - 1. So, if we replace function name with some sort of
        // stack then computation will basically look like this.
        //
        // Using recursion computation (only considering the else part of the recursion)
        // a(4,3)
        //       a((4 - 1), a(4, (3 - 1))
        //
        // As we can see value of m goes down by 1 in first fn call for second fn call value of m remains same but n
        // goes down by 1
        //
        // So, now doing same thing using stack it will be
        //
        // a(4,3)
        //       add (4) into the to be compute stack
        //
        //           add (4 - 1) into to be compute stack |
        //           add (4) into to be compute stack     |-- First iteration
        //           then decrease 3 by 1                 |
        //
        //           add (3 - 1) into to be compute stack |
        //           add (3) into to be compute stack     |-- Second iteration
        //           then decrease 2 by 1                 |
        //
        // until stack goes empty.

        $toBeSolved = [$m];

        while (!empty($toBeSolved)) {

            $i = array_pop($toBeSolved);

            if ($i < 4) {

                $n = self::applyAckermannFormula($i, $n);

            } elseif ($n === 0) {

                $toBeSolved[] = $i - 1;
                $n = 1;

            } else {

                $toBeSolved[] = $i - 1; // Decreased value of m
                $toBeSolved[] = $i;
                $n = $n - 1; // Decrement n by 1
            }

            self::$resultCache[$m][$n] = $n;
        }

        return self::$resultCache[$m][$n];
    }

    /**
     * This will clear the cache(array) of already calculated values.
     */
    public static function clearCache()
    {
        self::$resultCache = [];
    }

    /**
     * This method applies Ackermann formula for value of $m which is less than 4 and returns it.
     *
     * @param int $m
     * @param int $n
     *
     * @throws \InvalidArgumentException
     *
     * @return int
     */
    private function applyAckermannFormula($m, $n)
    {
        switch ($m) {

            case 0:
                $result = $n + 1;
                break;

            case 1:
                $result = $n + 2;
                break;

            case 2:
                $result = (2 * $n) + 3;
                break;

            case 3:
                $result = pow(2, ($n + 3)) - 3;
                break;

            default:
                throw new \InvalidArgumentException('Value of $m must between 0-3');
        }

        return $result;
    }
}