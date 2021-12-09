<?php

declare(strict_types=1);

namespace Adja20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Adja20\Dice\DiceDemonstration;

use function Adja20\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the dice route.
 */
class Dice
{
    public function view(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new DiceDemonstration();
        $callable->demonstrate();

        $data = [
            "header" => "Dice",
            "message" => "Here's a demonstration of my Dice-classes",
            "action" => url("/dice/process"),
            "numberOfFaces" => $_SESSION["numberOfFaces"] ?? null,
            "numberOfDice" => $_SESSION["numberOfDice"] ?? null,
            "diceHandRoll" => $_SESSION["diceHandRoll"] ?? null,
            "diceHandClass" => $_SESSION["diceHandClass"] ?? null
        ];

        $body = renderView("layout/dice.php", $data);

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
            ->withHeader("Location", url("/dice"));
    }
}
