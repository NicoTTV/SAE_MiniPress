<?php

namespace minipress\api\actions;



use FastRoute\RouteParser;
use minipress\api\services\article\ArticleService;
use minipress\api\services\exceptions\ArticleNotFoundException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class ArticleAction {
    public function __invoke(Request $request,Response $response, $args):Response {

        $id = $request->getQueryParams()['sort'] ?? '';
        $serviceArticle = new ArticleService();
        // Liste des catégories
        switch ($id){
            case "auteur":
                try {
                    $articles = $serviceArticle->orderArticleByAuteur();
                } catch (ArticleNotFoundException $e) {
                    throw new HttpInternalServerErrorException($request, $e->getMessage());
                }
                break;
            case "date-asc":
                try {
                    $articles = $serviceArticle->orderArticleByDateAsc();
                } catch (ArticleNotFoundException $e) {
                    throw new HttpInternalServerErrorException($request, $e->getMessage());
                }
                break;
            case"date-desc":
                try {
                    $articles = $serviceArticle->orderArticleByDateDesc();
                } catch (ArticleNotFoundException $e) {
                    throw new HttpInternalServerErrorException($request, $e->getMessage());
                }
                break;
            default:
                try {
                    $articles = $serviceArticle->getArticles();
                } catch (ArticleNotFoundException $e) {
                    throw new HttpInternalServerErrorException($request, $e->getMessage());
                }
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $articlesFormated = [];
        foreach ($articles as $article) {
            $article['links'] = [
                'self' => [
                    'href' => $routeParser->urlFor('articleId', ['id' => $article['id_article']])
                ]
                ];
            unset($article['id_article']);
            $articlesFormated[] = $article;
        }

        $dataFormated = [
            'type' => 'collection',
            'count' => count($articles),
            'articles' => $articlesFormated,
        ];

        // Convertir le tableau en JSON
        $json = json_encode($dataFormated);

        // Ajouter le contenu JSON à la réponse
        $response->getBody()->write($json);

        // Définir le type de contenu de la réponse comme JSON
        return $response->withHeader('Content-Type', 'application/json');
    }
}
