<?php

namespace actions;

use minipress\api\models\Article;

class ArticleAuteurAction {
    public function __invoke($request, $response, $args) {
        // Liste des catégories
        $id=$args['id'];
        $articles = Article::all()->where('id_user','=',$id);

        // Convertir le tableau en JSON
        $json = json_encode($articles);

        // Ajouter le contenu JSON à la réponse
        $response->getBody()->write($json);

        // Définir le type de contenu de la réponse comme JSON
        $response = $response->withHeader('Content-Type', 'application/json');

        return $response;
    }
}
