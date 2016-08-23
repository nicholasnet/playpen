<?php

/**
 * AckermannTest.php
 *
 * @author Nirmal <nirmalp@hotmail.com>
 */

use Playpen\Ackermann as A;

class AckermannTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param $m
     * @param $n
     * @param $expectedValues
     *
     * @test
     * @dataProvider getValidInputs
     */
    public function computes_value_recursively($m, $n, $expectedValues)
    {
        $this->assertEquals($expectedValues, A::computeRecursively($m, $n));
    }

    /**
     * @test
     * @dataProvider getValidInputs
     *
     * @param $m
     * @param $n
     * @param $expectedValues
     */
    public function computes_value_non_recursively($m, $n, $expectedValues)
    {
        A::clearCache();
        $this->assertEquals($expectedValues, A::computeNonRecursively($m, $n));
    }

    /**
     * @return array
     */
    public function getValidInputs()
    {
        return [
            [0, 0, 1],
            [0, 1, 2],
            [0, 2, 3],
            [0, 3, 4],
            [0, 4, 5],
            [1, 0, 2],
            [1, 1, 3],
            [1, 2, 4],
            [1, 3, 5],
            [1, 4, 6],
            [2, 0, 3],
            [2, 1, 5],
            [2, 2, 7],
            [2, 3, 9],
            [2, 4, 11],
            [3, 0, 5],
            [3, 1, 13],
            [3, 2, 29],
            [3, 3, 61],
            [3, 4, 125],
            [3, 7, 1021],
            [4, 0, 13],
            [4, 1, 65533],
        ];
    }
}
