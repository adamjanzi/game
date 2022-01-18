<?php

namespace Adja20\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GraphicalDice.
 */
class GraphicalDiceTest extends TestCase
{
    /**
     * Verify the graphicaldice object
     */
    public function testGraphicalDice()
    {
        $graphicalDice = new GraphicalDice();
        $this->assertInstanceOf("\Adja20\Dice\GraphicalDice", $graphicalDice);
    }

    /**
     * Verify that it returns the correct string for the graphic with one side.
     */
    public function testDiceGraphicOneSide()
    {
        $graphicalDice = new GraphicalDice();
        $graphicalDice->roll(1);
        $exp = "dice-1";
        $res = $graphicalDice->graphic();
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that it returns the correct string for the graphic with multiple sides.
     */
    public function testDiceGraphicMultipleSides()
    {
        $graphicalDice = new GraphicalDice();
        $graphicalDice->roll(6);
        $graphDiceLastRoll = $graphicalDice->getLastRoll();
        $exp = "dice-" . $graphDiceLastRoll;
        $res = $graphicalDice->graphic();
        $this->assertEquals($exp, $res);
    }
}
