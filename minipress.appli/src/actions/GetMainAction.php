<?php

namespace minipress\app\actions;

use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetMainAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $twig = Twig::fromRequest($rq);
        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            if ($user[0]['admin'] !== 1) {
                $user = null;
            }
        } else {
            $user = null;
        }
        try {
            return $twig->render($rs, 'acceuil.twig',['user'=>$user]);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}