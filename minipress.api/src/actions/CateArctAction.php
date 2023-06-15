<?php

namespace actions;

use models\Article;

require_once __DIR__ . '/../models/article.php';

class CateArctAction {
    public function __invoke($request, $response, $args) {
        // Liste des catégories
        $id=$args['id'];
        $articles = Article::select('titre','date_de_creation','id_user')->where('id_categorie', '=', $id)->get()->toArray();

        // Convertir le tableau en JSON
        $json = json_encode($articles);

        // Ajouter le contenu JSON à la réponse
        $response->getBody()->write($json);

        // Définir le type de contenu de la réponse comme JSON
        $response = $response->withHeader('Content-Type', 'application/json');

        return $response;
    }
}
