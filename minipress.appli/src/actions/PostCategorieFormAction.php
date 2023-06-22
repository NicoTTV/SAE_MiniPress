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

class PostCategorieFormAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $sac=[$_POST['titre'],$_POST['description']];
        $categorieService = new CategorieService();
        $beta=['reponse'=>$categorieService->addCategories($sac)];
        $twig = Twig::fromRequest($rq);

        try {
            return $twig->render($rs, 'categorie/categorie.twig',$beta);
        } catch (LoaderError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (RuntimeError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (SyntaxError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}