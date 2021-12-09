<?php

declare(strict_types=1);

namespace Adja20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Adja20\Dice\Yatzy;

use function Adja20\Functions\{
    destroySession,
    renderView,
    url,
    redirectTo
};

/**
 * Controller for the yatzy route.
 */
class YatzyController
{
    public function view(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Yatzy();
        $callable->playYatzy();

        $data = [
            "header" => "Yatzy",
            "message" => $_SESSION["message"] ?? null,
            "action" => url("/yatzy/process"),
            "yatzyDiceHandRoll" => $_SESSION["yatzyDiceHandRoll"] ?? null,
            "diceHandClass" => $_SESSION["diceHandClass"] ?? null,
            "diceHandRollSum" => $_SESSION["diceHandRollSum"] ?? null,
            "yatzyDiceHandRollGraphic" => $_SESSION["yatzyDiceHandRollGraphic"] ?? null,
            "bonus" => $_SESSION["bonus"] ?? null,
            "yatzyTotalScore" => $_SESSION["yatzyTotalScore"] ?? null,
            "buttonValue" => $_SESSION["buttonValue"] ?? null,
            "checkboxStatus" => $_SESSION["checkboxStatus"] ?? null
        ];

        $body = renderView("layout/yatzy.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function process(): ResponseInterface
    {
        if ($_SESSION["scoreIndex"] == 6) {
            destroySession();
        } else {
            $_SESSION["rollArray"][0] = $_POST["roll1"] ?? 1;
            $_SESSION["rollArray"][1] = $_POST["roll2"] ?? 1;
            $_SESSION["rollArray"][2] = $_POST["roll3"] ?? 1;
            $_SESSION["rollArray"][3] = $_POST["roll4"] ?? 1;
            $_SESSION["rollArray"][4] = $_POST["roll5"] ?? 1;
        }

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function destroy(): ResponseInterface
    {
        destroySession();

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/yatzy"));
    }
}
