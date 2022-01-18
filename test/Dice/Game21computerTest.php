<?php

namespace Adja20\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game21computer.
 */
class Game21computerTest extends TestCase
{
    /**
     * Verify the game21computer object
     * @runInSeparateProcess
     */
    public function testGame21computer()
    {
        $game21computer = new Game21computer();
        $this->assertInstanceOf("\Adja20\Dice\Game21computer", $game21computer);
    }

    /**
     * Verify the game21computer rolls return Int
     * @runInSeparateProcess
     */
    public function testGame21computerIsInt()
    {
        $game21computer = new Game21computer();
        $game21computer->playGame21();
        $this->assertIsInt($_SESSION["totalScore"]);
        $this->assertIsInt($_SESSION["computerTotalScore"]);
        $this->assertIsInt($_SESSION["roundScore"]);
        $this->assertIsInt($_SESSION["computerRoundScore"]);
        $this->assertIsInt($_SESSION["diceHandRollSum"]);
    }

    /**
     * Verify that the game21computer scores give the desired results upon computer scoring higher than 21.
     * @runInSeparateProcess
     */
    public function testGame21computerScoresOver21()
    {
        $game21computer = new Game21computer();
        $_SESSION["numberOfComputerDice"] = 22;
        $_SESSION["numberOfComputerDiceFaces"] = 1;
        $game21computer->playGame21();
        $roundScore = $_SESSION["roundScore"];
        $scoreMessage = $_SESSION["scoreMessage"];

        $scoreMessageExp = "YOU WON!";
        $roundScoreExp = 1;

        $this->assertEquals($scoreMessageExp, $scoreMessage);
        $this->assertEquals($roundScoreExp, $roundScore);
    }

    /**
     * Verify that the game21computer scores give the desired results upon computer scoring the same as player and not 21.
     * @runInSeparateProcess
     */
    public function testGame21computerScoresSameAsPlayerNot21()
    {
        $game21computer = new Game21computer();
        $_SESSION["numberOfComputerDice"] = 2;
        $_SESSION["numberOfComputerDiceFaces"] = 1;
        $_SESSION["totalScore"] = 2;
        $game21computer->playGame21();
        $compRoundScore = $_SESSION["computerRoundScore"];
        $scoreMessage = $_SESSION["scoreMessage"];

        $scoreMessageExp = "YOU LOSE!";
        $compRoundScoreExp = 1;

        $this->assertEquals($scoreMessageExp, $scoreMessage);
        $this->assertEquals($compRoundScoreExp, $compRoundScore);
    }

     /**
     * Verify that the game21computer scores give the desired results upon computer scoring higher than player and not 21.
     * @runInSeparateProcess
     */
    public function testGame21computerScoresHigherThanPlayerNot21()
    {
        $game21computer = new Game21computer();
        $_SESSION["numberOfComputerDice"] = 13;
        $_SESSION["numberOfComputerDiceFaces"] = 1;
        $_SESSION["totalScore"] = 3;
        $game21computer->playGame21();
        $compRoundScore = $_SESSION["computerRoundScore"];
        $scoreMessage = $_SESSION["scoreMessage"];

        $scoreMessageExp = "YOU LOSE!";
        $compRoundScoreExp = 1;

        $this->assertEquals($scoreMessageExp, $scoreMessage);
        $this->assertEquals($compRoundScoreExp, $compRoundScore);
    }

    /**
     * Verify that the game21computer scores give the desired results upon computer scoring lower than the player.
     * @runInSeparateProcess
     */
    public function testGame21computerScoresLowerThanPlayer()
    {
        $game21computer = new Game21computer();
        $_SESSION["scoreTest"] = 1;
        $_SESSION["numberOfComputerDice"] = 2;
        $_SESSION["numberOfComputerDiceFaces"] = 1;
        $_SESSION["totalScore"] = 5;
        $game21computer->playGame21();
        $scoreMessage = $_SESSION["scoreMessage"];

        $scoreMessageExp = "";

        $this->assertEquals($scoreMessageExp, $scoreMessage);
    }
}
