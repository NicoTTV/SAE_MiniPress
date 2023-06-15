<?php

namespace minipress\app\actions;

use minipress\app\services\exceptions\BadDataUserException;
use minipress\app\services\exceptions\UserNotFoundException;
use minipress\app\services\exceptions\UserRegisterException;
use minipress\app\services\user\UserService;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PostInscriptionAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $data = $rq->getParsedBody();
        $userService = new UserService();
        try {
            $userService->inscription($data);
        } catch (BadDataUserException|UserNotFoundException|UserRegisterException $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
        return $rs->withHeader('Location', '/')->withStatus(302);
    }
}