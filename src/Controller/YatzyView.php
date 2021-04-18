<?php

declare(strict_types=1);

namespace Fian\Controller;

//use Nyholm\Psr7\Factory\Psr17Factory;
//use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

use function Fian\Functions\renderTwigView;

use function Fian\Functions\{
    destroySession,
    renderView,
    url,
    getRoutePath,
    happySession,
    yatzy
};
/**
 * Controller for showing how Twig views works.
 */
 class YatzyView
 {
     use ControllerTrait;

     public function index(): ResponseInterface
     {

        $data = [
            "header" => "Yatzy page",
            "message" => "YATZY!.",
        ];

        $body = renderView("layout/yatzy.php", $data);

        return $this->response($body);

    }
    public function info(): ResponseInterface
    {

        yatzy();

        $data = [
            "header" => "Yatzy page",
            "message" => "A ROLL WAS MADE",
        ];

        $body = renderView("layout/yatzy.php", $data);

        return $this->response($body);
    }
}
