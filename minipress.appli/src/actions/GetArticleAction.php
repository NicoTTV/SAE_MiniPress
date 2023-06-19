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

class GetArticleAction extends AbstractAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $twig = Twig::fromRequest($rq);

        if(isset($_GET['categorie'])){
            $cate = $_GET['categorie'];
            if($cate=="Aucune"){
                $testing="Aucune Catégorie";
                $info = Article::all();
            }else{
            $beta = Categorie::where('titre', $cate)->value('id-categorie');
            $testing=$cate;
            $info = Article::where('id_categorie',$beta)->get();
            }
        }else{
            $testing="Aucune Catégorie";
            $info = Article::all();
        }

        $info2 = Categorie::all();

        $ajout=['articles'=>$info,'categories'=>$info2, 'nombre'=>$testing];

        try {
            return $twig->render($rs, 'article/article.twig',$ajout);
        } catch (LoaderError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (RuntimeError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        } catch (SyntaxError $e) {
            throw new HttpInternalServerErrorException($rq, $e->getMessage());
        }
    }
}