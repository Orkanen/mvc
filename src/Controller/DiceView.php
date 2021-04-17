<?php

declare(strict_types=1);

namespace Fian\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

use function Fian\Functions\renderTwigView;

use function Fian\Functions\{
    destroySession,
    renderView,
    url,
    getRoutePath,
    testSession
};
/**
 * Controller for showing how Twig views works.
 */
class DiceView
{
    public function index(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $body = renderView("layout/dice.php");

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
    public function info(): ResponseInterface
    {
        testSession();


        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/dice"));
    }
}
