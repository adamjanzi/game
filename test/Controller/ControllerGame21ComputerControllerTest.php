<?php

declare(strict_types=1);

namespace Adja20\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Game21ComputerController.
 */
class ControllerGame21ComputerControllerTest extends TestCase
{
    /**
     * Try to create the controller class.
     * @runInSeparateProcess
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21ComputerController();
        $this->assertInstanceOf("\Adja20\Controller\Game21ComputerController", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerReturnsResponse()
    {
        $controller = new Game21ComputerController();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->view();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check the controller process action.
     * @runInSeparateProcess
     */
    public function testControllerProcessAction()
    {
        $_POST["content"] = 2;
        $_POST["content1"] = 5;
        $controller = new Game21ComputerController();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->process();
        $this->assertInstanceOf($exp, $res);
        $this->assertEquals(2, $_SESSION["numberOfFaces"]);
        $this->assertEquals(5, $_SESSION["numberOfDice"]);
    }

    /**
     * Check the controller destroy action.
     * @runInSeparateProcess
     */
    public function testControllerDestroyAction()
    {
        session_start();
        $controller = new Game21ComputerController();

        $_SESSION = [
            "key" => "value"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->destroy();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }

    /**
     * Check the controller newround action.
     * @runInSeparateProcess
     */
    public function testControllerNewRoundAction()
    {
        $controller = new Game21ComputerController();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $_SESSION["totalScore"] = 1;
        $res = $controller->newround();
        $this->assertInstanceOf($exp, $res);
        $this->assertEquals(0, $_SESSION["totalScore"]);
    }
}
