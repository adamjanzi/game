<?php

namespace Adja20\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    /**
     * Verify the dicehand object
     */
    public function testDiceHand()
    {
        $diceHand = new DiceHand(2);
        $this->assertInstanceOf("\Adja20\Dice\DiceHand", $diceHand);
    }
    /**
     * Verify that the dicehand gets the last roll.
     */
    public function testDiceHandGetLastRoll()
    {
        $numberOfDice = 1;
        $numberOfSides = 1;
        $diceHand = new DiceHand($numberOfDice);
        $diceHand->roll($numberOfSides);
        $lastRollRes = $diceHand->getLastRoll();
        $exp = "1";
        $res = $lastRollRes;
        $this->assertEquals($exp, $res);

        $numberOfDice = 2;
        $numberOfSides = 1;
        $diceHand2 = new DiceHand($numberOfDice);
        $diceHand2->roll($numberOfSides);
        $lastRollRes2 = $diceHand2->getLastRoll();
        $exp2 = "1, 1";
        $res2 = $lastRollRes2;
        $this->assertEquals($exp2, $res2);
    }

    /**
     * Verify that the dicehand gets the last roll sum.
     */
    public function testDiceHandGetLastRollSum()
    {
        $numberOfDice = 7;
        $numberOfSides = 1;
        $diceHand = new DiceHand($numberOfDice);
        $diceHand->roll($numberOfSides);
        $lastRollSumRes = $diceHand->getLastRollSum();
        $exp = 7;
        $res = $lastRollSumRes;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that the dicehand gets the correct graphic class.
     */
    public function testDiceHandGetLastClass()
    {
        $numberOfDice = 3;
        $numberOfSides = 1;
        $diceHand = new DiceHand($numberOfDice);
        $diceHand->roll($numberOfSides);
        $lastClassRes = $diceHand->getLastClass();
        $exp = "<i class='dice-1'></i><i class='dice-1'></i><i class='dice-1'></i>";
        $res = $lastClassRes;
        $this->assertEquals($exp, $res);
    }
}
