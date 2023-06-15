<?php

namespace minipress\app\actions;

use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetConnexionAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {

        $twig = Twig::fromRequest($rq);
        try {
            return $twig->render($rs, 'user/connexion.twig');
        } catch (LoaderError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (RuntimeError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (SyntaxError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}