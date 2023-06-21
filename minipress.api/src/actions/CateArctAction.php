<?php

namespace minipress\api\actions;



use minipress\api\models\Article;
use minipress\api\services\article\ArticleService;
use minipress\api\services\exceptions\ArticleNotFoundException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Routing\RouteContext;

class CateArctAction {
    public function __invoke($request, $response, $args) {
        // Liste des catégories
        $id=$args['id'];
        $articleService = new ArticleService();
        try {
            $articles = $articleService->getArticles();
        } catch (ArticleNotFoundException $e) {
            throw new HttpInternalServerErrorException($request, $e->getMessage());
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $articlesFormated = [];
        foreach ($articles as $article) {
            $article['links'] = [
                'self' => [
                    'href' => $routeParser->urlFor('articleId', ['id' => $article['id_article']])
                ]
            ];
            $articlesFormated[] = $article;
        }

        $dataFormated = [
            'type' => 'collection',
            'count' => count($articles),
            'articles' => $articlesFormated
        ];

        // Convertir le tableau en JSON
        $json = json_encode($dataFormated);

        // Ajouter le contenu JSON à la réponse
        $response->getBody()->write($json);

        // Définir le type de contenu de la réponse comme JSON
        $response = $response->withHeader('Content-Type', 'application/json');

        return $response;
    }
}
