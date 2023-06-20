<?php

namespace minipress\api\actions;

use minipress\api\models\Categorie;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategorieAction extends AbstractAction {
    public function __invoke(Request $request, Response $response, $args):Response {
        // Liste des catégories
        $categorieService = new CategorieService();
        $categories = $categorieService->getAllCategories();

        // Convertir le tableau en JSON
        $json = json_encode($categories);

        // Ajouter le contenu JSON à la réponse
        $response->getBody()->write($json);

        // Définir le type de contenu de la réponse comme JSON
        return $response->withHeader('Content-Type', 'application/json');
    }
}
