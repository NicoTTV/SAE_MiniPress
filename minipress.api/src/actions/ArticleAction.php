<?php

namespace minipress\api\actions;



use minipress\api\models\Article;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ArticleAction {
    public function __invoke(Request $request,Response $response, $args):Response {

        $id = $request->getQueryParams()['sort'] ?? '';
        // Liste des catégories
        switch ($id){
            case "auteur":
                $articles = Article::select('titre','date_de_creation','id_user')->orderBy('id_user')->get()->toArray();

                break;
            case "date-asc":
                $articles = Article::select('titre','date_de_creation','id_user')->orderBy('date_de_creation', 'asc')->get()->toArray();

                break;
            case"date-desc":
                $articles = Article::select('titre','date_de_creation','id_user')->orderBy('date_de_creation', 'desc')->get()->toArray();

                break;
            default:
                $articles = Article::select('titre','date_de_creation','id_user')->get()->toArray();
        }

        // Convertir le tableau en JSON
        $json = json_encode($articles);

        // Ajouter le contenu JSON à la réponse
        $response->getBody()->write($json);

        // Définir le type de contenu de la réponse comme JSON
        return $response->withHeader('Content-Type', 'application/json');
    }
}
