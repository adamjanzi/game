<?php

declare(strict_types=1);

namespace Adja20\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller YatzyController.
 */
class ControllerYatzyControllerTest extends TestCase
{
    /**
     * Try to create the controller class.
     * @runInSeparateProcess
     */
    public function testCreateTheControllerClass()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("\Adja20\Controller\YatzyController", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerReturnsResponse()
    {
        $controller = new YatzyController();
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
        session_start();
        $_SESSION["scoreIndex"] = 1;
        $controller = new YatzyController();
        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->process();
        $this->assertInstanceOf($exp, $res);
        $this->assertEquals(1, $_SESSION["rollArray"][0]);
        $this->assertEquals(1, $_SESSION["rollArray"][1]);
        $this->assertEquals(1, $_SESSION["rollArray"][2]);
        $this->assertEquals(1, $_SESSION["rollArray"][3]);
        $this->assertEquals(1, $_SESSION["rollArray"][4]);
        $_SESSION["scoreIndex"] = 6;
        $controller->process();
        $this->assertEmpty($_SESSION);
    }

    /**
     * Check the controller destroy action.
     * @runInSeparateProcess
     */
    public function testControllerDestroyAction()
    {
        session_start();
        $controller = new YatzyController();

        $_SESSION = [
            "key" => "value"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->destroy();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }
}
