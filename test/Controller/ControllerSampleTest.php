<?php

declare(strict_types=1);

namespace Fian\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class ControllerSampleTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Sample();
        $this->assertInstanceOf("\Fian\Controller\Sample", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testControllerReturnsResponse()
    {
        $controller = new Sample();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->where();
        $this->assertInstanceOf($exp, $res);
    }
}
