<?php

namespace minipress\app\actions;

use minipress\app\services\exceptions\BadDataUserException;
use minipress\app\services\exceptions\ExceptionTokenVerify;
use minipress\app\services\exceptions\UserNotFoundException;
use minipress\app\services\exceptions\UserRegisterException;
use minipress\app\services\utils\Auth;
use minipress\app\services\utils\CsrfService;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PostInscriptionByAdmin extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $data = $rq->getParsedBody();
        try {
            CsrfService::check($data['csrf'] ?? '');
        } catch (ExceptionTokenVerify $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
        try {
            $userService = new Auth();
            $userService->inscriptionByAdmin($data);
        } catch (BadDataUserException|UserNotFoundException|UserRegisterException $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
        return $rs->withHeader('Location', '/')->withStatus(302);
    }
}