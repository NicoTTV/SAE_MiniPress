<?php

namespace minipress\app\actions;

use Exception;
use minipress\app\services\categorie\CategorieService;
use minipress\app\services\exceptions\CategorieNotFoundException;
use minipress\app\services\utils\Auth;
use minipress\app\services\utils\CsrfService;
use minipress\app\services\exceptions\ExceptionTokenGenerate;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetArticleFormAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        try {
            $csrf = CsrfService::generate();
        } catch (ExceptionTokenGenerate $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }

        try {
            $categorieService = new CategorieService();
            $categories = $categorieService->getAllCategories();
        }catch (CategorieNotFoundException $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
        $user = Auth::getCurrentUser();

        try {
            $twig = Twig::fromRequest($rq);
            return $twig->render($rs, 'article/articleForm.twig', ['csrf' => $csrf, 'user' => $user, "categories" => $categories]);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}