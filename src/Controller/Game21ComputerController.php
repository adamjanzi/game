<?php

declare(strict_types=1);

namespace Adja20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Adja20\Dice\Game21computer;

use function Adja20\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the game21computer route.
 */
class Game21ComputerController
{
    public function view(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Game21computer();
        $callable->playGame21();

        $data = [
            "header" => "Game 21",
            "action" => url("/game21computer/process"),
            "numberOfFaces" => $_SESSION["numberOfFaces"] ?? null,
            "numberOfDice" => $_SESSION["numberOfDice"] ?? null,
            "totalScore" => $_SESSION["totalScore"] ?? 0,
            "diceHandRoll" => $_SESSION["diceHandRoll"] ?? null,
            "diceHandClass" => $_SESSION["diceHandClass"] ?? null,
            "computerTotalScore" => $_SESSION["computerTotalScore"] ?? 0,
            "scoreMessage" => $_SESSION["scoreMessage"] ?? null
        ];

        $body = renderView("layout/game21computer.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function process(): ResponseInterface
    {
        $_SESSION["numberOfFaces"] = $_POST["content"] ?? null;
        $_SESSION["numberOfDice"] = $_POST["content1"] ?? null;

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21computer"));
    }

    public function destroy(): ResponseInterface
    {
        destroySession();

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21"));
    }

    public function newround(): ResponseInterface
    {
        $_SESSION["totalScore"] = 0;

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21"));
    }
}
