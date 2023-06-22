<?php

namespace minipress\app\actions;

use Exception;
use minipress\app\services\article\ArticleService;
use minipress\app\services\exceptions\BadDataArticelException;
use minipress\app\services\exceptions\ExceptionTokenVerify;
use minipress\app\services\utils\CsrfService;
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

        try {
            CsrfService::check($data['csrf'] ?? '');
        } catch (ExceptionTokenVerify $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $image = $uploadedFiles['image'] ?? null;
        try {
            $articleService->createArticle($data,$image);
        } catch (BadDataArticelException $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }

        // A modifier plus tard quand on aura la page de l'article
        try {
            return $rs->withHeader('Location', RouteContext::fromRequest($rq)->getRouteParser()->urlFor('form.article'))->withStatus(302);
        }catch (Exception $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}