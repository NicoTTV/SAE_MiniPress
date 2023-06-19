<?php

namespace minipress\app\actions;

use minipress\app\services\article\ArticleService;
use minipress\app\services\exceptions\BadDataArticelException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PostArticleFormAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {

        $data = $rq->getParsedBody();
        $articleService = new ArticleService();
        $uploadedFiles = $rq->getUploadedFiles();

        $image = $uploadedFiles['image'] ?? null;
        try {
            $articleService->createArticle($data,$image);
        } catch (BadDataArticelException $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $twig = Twig::fromRequest($rq);
        try {
            return $twig->render($rs, 'article/articleForm.twig');
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}