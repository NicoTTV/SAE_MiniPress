<?php

namespace actions;

use models\Article;

require_once __DIR__ . '/../models/article.php';

class ArticleAction {
    public function __invoke($request, $response, $args) {
        // Liste des catégories
        $categories = Article::all();

        // Convertir le tableau en JSON
        $json = json_encode($categories);

        // Ajouter le contenu JSON à la réponse
        $response->getBody()->write($json);

        // Définir le type de contenu de la réponse comme JSON
        $response = $response->withHeader('Content-Type', 'application/json');

        return $response;
    }
}
