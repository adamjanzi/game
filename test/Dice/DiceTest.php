<?php

namespace Adja20\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Verify the dice object
     */
    public function testDice()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Adja20\Dice\Dice", $dice);
    }
    /**
     * Verify that the rolling returns an int.
     */
    public function testDiceIntRoll()
    {
        $dice = new Dice();
        $this->assertIsInt($dice->roll(6));
    }

    /**
     * Verify that the rolling doesn't return a number too high
     */
    public function testDiceRoll()
    {
        $dice = new Dice();
        $this->assertLessThanOrEqual(6, $dice->roll(6));
    }

    /**
     * Verify that we can get the last roll
     */
    public function testDiceLastRoll()
    {
        $dice = new Dice();
        $dice->roll(1);
        $this->assertEquals(1, $dice->getLastRoll());
    }
}
