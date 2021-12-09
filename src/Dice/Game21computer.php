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
 * Class Game21computer.
 */
class Game21computer
{

    public function playGame21(): void
    {
        //$data = [
        //    "header" => "Game 21",
        //    "action" => url("/game21computer/process"),
        //    "computerTotalScore" => $_SESSION["computerTotalScore"] ?? 0
        //];

        $scoreMessage = "";
        $diceHand = "";

        if (!isset($_SESSION["computerTotalScore"])) {
            $_SESSION["computerTotalScore"] = 0;
        }

        if (isset($_SESSION["numberOfDice"])) {
            $diceHand = new DiceHand(1);
        }

        if (!isset($_SESSION["numberOfDice"])) {
            $diceHand = new DiceHand(1);
        }

        for ($_SESSION["computerTotalScore"] = 0; $_SESSION["computerTotalScore"] < 21; $_SESSION["computerTotalScore"] += $diceHand->getLastRollSum()) {
            $diceHand->roll(6);
            $_SESSION["computerTotalScore"] += $diceHand->getLastRollSum();

            if ($_SESSION["computerTotalScore"] == $_SESSION["totalScore"]) {
                break;
            } else if ($_SESSION["computerTotalScore"] > $_SESSION["totalScore"] && $_SESSION["computerTotalScore"] < 21) {
                break;
            } else if ($_SESSION["computerTotalScore"] > 21) {
                break;
            }
        }

        if ($_SESSION["computerTotalScore"] > 21) {
            $scoreMessage = "YOU WON!";
            $_SESSION["roundScore"] += 1;
        } else if ($_SESSION["computerTotalScore"] == $_SESSION["totalScore"] && $_SESSION["computerTotalScore"] != 21) {
            $scoreMessage = "YOU LOSE!";
            $_SESSION["computerRoundScore"] += 1;
        } else if ($_SESSION["computerTotalScore"] > $_SESSION["totalScore"] && $_SESSION["computerTotalScore"] < 21) {
            $scoreMessage = "YOU LOSE!";
            $_SESSION["computerRoundScore"] += 1;
        } else {
            $scoreMessage = "";
        }

        $_SESSION["diceHandRollSum"] = $diceHand->getLastRollSum();
        $_SESSION["scoreMessage"] = $scoreMessage;


        //$body = renderView("layout/game21computer.php", $data);
        //sendResponse($body);
    }
}
