<?php

namespace Adja20\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceDemonstration.
 */
class DiceDemonstrationTest extends TestCase
{
    /**
     * Verify the dicedemonstration object
     * @runInSeparateProcess
     */
    public function testDiceDemonstration()
    {
        $diceDemonstration = new DiceDemonstration();
        $this->assertInstanceOf("\Adja20\Dice\DiceDemonstration", $diceDemonstration);
    }

    /**
     * Verify the dicedemonstration rolls are Int.
     * @runInSeparateProcess
     */
    public function testDiceDemonstrationIsInt()
    {
        $diceDemonstration = new DiceDemonstration();
        $diceDemonstration->demonstrate();
        $this->assertIsInt($_SESSION["dieLastRoll"]);
        $this->assertIsInt($_SESSION["graphicalDieLastRoll"]);
    }

    /**
     * Verify the dicedemonstration gives the desired results with controlled inputs.
     * @runInSeparateProcess
     */
    public function testDiceDemonstrationIsSet()
    {
        $diceDemonstration = new DiceDemonstration();
        $_SESSION["numberOfFaces"] = 1;
        $_SESSION["numberOfDice"] = 4;
        $diceDemonstration->demonstrate();
        $dieLastRoll = $_SESSION["dieLastRoll"];
        $graphicalDieLastRoll = $_SESSION["graphicalDieLastRoll"];
        $diceHandRoll = $_SESSION["diceHandRoll"];
        $diceHandClass = $_SESSION["diceHandClass"];

        $this->assertIsInt($dieLastRoll);
        $this->assertIsInt($graphicalDieLastRoll);
        $this->assertEquals(1, $dieLastRoll);
        $this->assertEquals("1, 1, 1, 1", $diceHandRoll);
        $this->assertEquals("<i class='dice-1'></i><i class='dice-1'></i><i class='dice-1'></i><i class='dice-1'></i>", $diceHandClass);
    }
}
