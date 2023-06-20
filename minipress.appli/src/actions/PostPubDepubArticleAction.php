<?php

namespace minipress\app\actions;

use minipress\app\models\Article;
use minipress\app\services\article\ArticleService;
use minipress\app\services\exceptions\ArticleNotFoundException;
use minipress\app\services\exceptions\BadDataArticelException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class PostPubDepubArticleAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $data = $rq->getParsedBody();
        $articleService = new ArticleService();
        $idArticle = $data['article'];

        try {
            $articleService->changePublicationStatutArticle($idArticle);
        } catch (ArticleNotFoundException|BadDataArticelException $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();

        return $rs->withHeader('Location', $routeParser->urlFor('article'))->withStatus(302);
    }
}