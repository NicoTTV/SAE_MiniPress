<?php

namespace minipress\api\actions;



use minipress\api\models\Article;
use minipress\api\services\article\ArticleService;
use minipress\api\services\exceptions\ArticleNotFoundException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Routing\RouteContext;

class ArticleCompletAction {
    public function __invoke($request, $response, $args) {
        // Liste des catégories
        $id=$args['id'];
        $articleService = new ArticleService();
        try {
            $article = $articleService->getArticleById($id);
        } catch (ArticleNotFoundException $e) {
            throw new HttpInternalServerErrorException($request, $e->getMessage());
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $articleFormated = [
            $article,
            'links' => [
                'articles' => [
                    'href' => $routeParser->urlFor('articles')
                ]
            ],
        ];

        $dataFormated = [
            'type' => 'ressource',
            'article' => $articleFormated
        ];

        // Convertir le tableau en JSON
        $json = json_encode($dataFormated);

        // Ajouter le contenu JSON à la réponse
        $response->getBody()->write($json);

        // Définir le type de contenu de la réponse comme JSON
        return $response->withHeader('Content-Type', 'application/json');
    }
}
