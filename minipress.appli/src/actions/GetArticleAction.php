<?php

namespace minipress\app\actions;

use minipress\app\models\Article;
use minipress\app\models\Categorie;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use minipress\app\services\article\ArticleService;
use minipress\app\services\categorie\CategorieService;

class GetArticleAction extends AbstractAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $articleService = new ArticleService();
        $categorieService = new CategorieService();
        $twig = Twig::fromRequest($rq);

        if (isset($_GET['categorie'])) {
            $categorie = $_GET['categorie'];
            if ($categorie == "Aucune") {
                $testing = "Aucune Catégorie";
                $info = $articleService->getArticles();
            } else {
                $beta = $categorieService->getIdFromTitre($categorie);
                $testing = $categorie;
                $info = $articleService->getArticleByCategorie($beta);
            }
        } else {
            $testing = "Aucune Catégorie";
            $info = $articleService->getArticles();
        }

        $info2 = $categorieService->getAllCategories();

        $ajout = ['articles' => $info, 'categories' => $info2, 'nombre' => $testing];

        try {
            return $twig->render($rs, 'article/article.twig', $ajout);
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}
