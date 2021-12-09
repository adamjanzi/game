<?php

declare(strict_types=1);

namespace Adja20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Adja20\Dice\Game21;

use function Adja20\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the game21 route.
 */
class Game21Controller
{
    public function view(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Game21();
        $callable->playGame21();

        $data = [
            "header" => "Game 21",
            "message" => "Welcome to Game 21!",
            "action" => url("/game21/process"),
            "numberOfFaces" => $_SESSION["numberOfFaces"] ?? null,
            "numberOfDice" => $_SESSION["numberOfDice"] ?? null,
            "totalScore" => $_SESSION["totalScore"] ?? 0,
            "diceHandRoll" => $_SESSION["diceHandRoll"] ?? null,
            "diceHandClass" => $_SESSION["diceHandClass"] ?? null,
            "scoreMessage" => $_SESSION["scoreMessage"] ?? null
        ];

        $body = renderView("layout/game21.php", $data);

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
            ->withHeader("Location", url("/game21"));
    }

    public function destroy(): ResponseInterface
    {
        destroySession();

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21"));
    }
}
