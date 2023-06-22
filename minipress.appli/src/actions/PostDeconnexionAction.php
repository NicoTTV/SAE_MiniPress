<?php

namespace minipress\app\actions;

use minipress\app\services\exceptions\ExceptionTokenVerify;
use minipress\app\services\utils\CsrfService;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class PostDeconnexionAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $data = $rq->getParsedBody();
        try {
            CsrfService::check($data['csrf'] ?? '');
        } catch (ExceptionTokenVerify $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
        session_destroy();
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        return $rs->withHeader('Location', $routeParser->urlFor('home'))->withStatus(302);
    }
}