<?php
/**
 * Ackermann.php
 *
 * @author Nirmal <nirmalp@hotmail.com>
 */

namespace Playpen;

/**
 * Class Ackermann
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
     * This function computes Ackermann function recursively given m >= 0 and n >= 0
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

            self::applyAckermannFormula($m, $n);

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
    }

    /**
     * This method applies Ackermann formula for value of $m which is less than 4.
     *
     * @param int $m
     * @param int $n
     */
    private function applyAckermannFormula($m, $n)
    {
        // Lets check the cache first if values is in cache then no need to compute.
        if (isset(self::$resultCache[$m][$n])) {

            return;

        }

        switch ($m) {

            case 0:
                self::$resultCache[$m][$n] = $n + 1;
                break;

            case 1:
                self::$resultCache[$m][$n] = $n + 2;
                break;

            case 2:
                self::$resultCache[$m][$n] = (2 * $n) + 3;
                break;

            case 3:
                self::$resultCache[$m][$n] = pow(2, ($n + 3)) - 3;
                break;
        }
    }
}