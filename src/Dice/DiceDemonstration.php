<?php

declare(strict_types=1);

namespace Adja20\Dice;

use Adja20\Dice\Dice;
use Adja20\Dice\GraphicalDice;
use Adja20\Dice\DiceHand;

use function Adja20\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

/**
 * Class DiceDemonstration.
 */
class DiceDemonstration
{

    public function demonstrate(): void
    {
        $data = [
            "header" => "Dice",
            "message" => "Here's a demonstration of my Dice-classes",
            "action" => url("/dice/process"),
            "numberOfFaces" => $_SESSION["numberOfFaces"] ?? null,
            "numberOfDice" => $_SESSION["numberOfDice"] ?? null
        ];

        $graphicalDiceSides = 6;

        $die = new Dice();
        $graphicalDie = new GraphicalDice();

        if (isset($_SESSION["numberOfFaces"])) {
            $die->roll(intval($_SESSION["numberOfFaces"]));
        }

        if (!isset($_SESSION["numberOfFaces"])) {
            $die->roll(6);
        }

        $graphicalDie->roll($graphicalDiceSides);

        if (isset($_SESSION["numberOfDice"])) {
            $diceHand = new DiceHand(intval($_SESSION["numberOfDice"]));
        }

        if (!isset($_SESSION["numberOfDice"])) {
            $diceHand = new DiceHand(1);
        }

        if (isset($_SESSION["numberOfFaces"])) {
            $diceHand->roll(intval($_SESSION["numberOfFaces"]));
        }

        if (!isset($_SESSION["numberOfFaces"])) {
            $diceHand->roll(6);
        }

        $data["dieLastRoll"] = $die->getLastRoll();
        $data["graphicalDieLastRoll"] = $graphicalDie->getLastRoll();
        $data["class"] = $graphicalDie->graphic();
        $data["diceHandRoll"] = $diceHand->getLastRoll();
        $data["diceHandClass"] = $diceHand->getLastClass();

        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }
}