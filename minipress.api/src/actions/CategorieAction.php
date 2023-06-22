<?php

namespace minipress\api\actions;

use minipress\api\services\categorie\CategorieService;
use minipress\api\services\exceptions\CategorieNotFoundException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class CategorieAction extends AbstractAction {
    public function __invoke(Request $request, Response $response, $args):Response {
        // Liste des catégories
        $categorieService = new CategorieService();
        try {
            $categories = $categorieService->getAllCategories();
        } catch (CategorieNotFoundException $e) {
            throw new HttpInternalServerErrorException($request, $e->getMessage());
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $categoriesFormated = [];
        foreach ($categories as $categorie) {
            $categorie['links'] = [
                'self' => [
                    'href' => $routeParser->urlFor('categorie2Articles', ['id' => $categorie['id_categorie']]),
                ],
            ];
            $categoriesFormated[] = $categorie;
        }

        $dataFormated = [
            "type" => "collection",
            "count" => count($categories),
            "categories" => $categoriesFormated
        ];

        // Convertir le tableau en JSON
        $json = json_encode($dataFormated);

        // Ajouter le contenu JSON à la réponse
        $response->getBody()->write($json);

        // Définir le type de contenu de la réponse comme JSON
        return $response->withHeader('Content-Type', 'application/json');
    }
}
