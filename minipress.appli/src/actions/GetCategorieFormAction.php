<?php

namespace minipress\app\actions;

use minipress\app\models\Article;
use minipress\app\models\Categorie;
use minipress\app\services\exceptions\ExceptionTokenGenerate;
use minipress\app\services\utils\CsrfService;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetCategorieFormAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $twig = Twig::fromRequest($rq);
        try {
            $csrf = CsrfService::generate();
        } catch (ExceptionTokenGenerate $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
        try {
            return $twig->render($rs, 'categorie/categorie.twig',['csrf'=>$csrf]);
        } catch (LoaderError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (RuntimeError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (SyntaxError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}