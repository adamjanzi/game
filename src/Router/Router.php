<?php

declare(strict_types=1);

namespace Adja20\Router;

use Adja20\Dice\DiceDemonstration;
use Adja20\Dice\Game21;
use Adja20\Dice\Game21computer;

use function Adja20\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/form/view") {
            $data = [
                "header" => "Form",
                "message" => "Press submit to send the message to the result page.",
                "action" => url("/form/process"),
                "output" => $_SESSION["output"] ?? null,
            ];
            $body = renderView("layout/form.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/form/process") {
            $_SESSION["output"] = $_POST["content"] ?? null;
            redirectTo(url("/form/view"));
            return;
        } else if ($method === "GET" && $path === "/dice") {
            $callable = new \Adja20\Dice\DiceDemonstration();
            $callable->demonstrate();
            return;
        } else if ($method === "POST" && $path === "/dice/process") {
            $_SESSION["numberOfFaces"] = $_POST["content"] ?? null;
            $_SESSION["numberOfDice"] = $_POST["content1"] ?? null;
            redirectTo(url("/dice"));
            return;
        } else if ($method === "GET" && $path === "/game21") {
            $callable = new \Adja20\Dice\Game21();
            $callable->playGame21();
            return;
        } else if ($method === "GET" && $path === "/game21computer") {
            $callable = new \Adja20\Dice\Game21computer();
            $callable->playGame21();
            return;
        } else if ($method === "POST" && $path === "/game21/process") {
            $_SESSION["numberOfFaces"] = $_POST["content"] ?? null;
            $_SESSION["numberOfDice"] = $_POST["content1"] ?? null;
            redirectTo(url("/game21"));
            return;
        } else if ($method === "GET" && $path === "/game21/destroy") {
            destroySession();
            redirectTo(url("/game21"));
            return;
        } else if ($method === "GET" && $path === "/game21computer/destroy") {
            destroySession();
            redirectTo(url("/game21"));
            return;
        } else if ($method === "GET" && $path === "/game21computer/newround") {
            $_SESSION["totalScore"] = 0;
            redirectTo(url("/game21"));
            return;
        }


        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
