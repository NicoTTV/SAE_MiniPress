<?php

namespace minipress\app\actions;

use minipress\app\services\exceptions\ExceptionTokenGenerate;
use minipress\app\services\utils\CsrfService;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetInscriptionByAdmin extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $twig = Twig::fromRequest($rq);
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('inscription.admin');
        try {
            $csrf = CsrfService::generate();
        } catch (ExceptionTokenGenerate $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
        try {
            return $twig->render($rs, 'user/inscription_admin.twig',['url'=>$url,'csrf'=>$csrf]);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}