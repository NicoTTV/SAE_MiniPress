<?php

namespace minipress\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class PostDeconnexionAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        session_destroy();
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        return $rs->withHeader('Location', $routeParser->urlFor('home'))->withStatus(302);
    }
}