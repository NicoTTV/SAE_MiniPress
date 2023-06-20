<?php

namespace minipress\app\actions;

use minipress\app\services\exceptions\BadDataUserException;
use minipress\app\services\exceptions\UserNotFoundException;
use minipress\app\services\utils\Auth;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PostConnexionAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $data = $rq->getParsedBody();
        $userService = new Auth();
        try {
            $userService->connexion($data);
        } catch (BadDataUserException|UserNotFoundException $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
        return $rs->withHeader('Location', '/')->withStatus(302);
    }
}