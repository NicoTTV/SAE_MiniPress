<?php

namespace minipress\api\services\article;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use minipress\api\models\Article;
use minipress\api\services\exceptions\ArticleNotFoundException;

class ArticleService
{
    /**
     * @throws ArticleNotFoundException
     */
    public function getArticles(): array
    {
        try {
            return Article::select('id_article','titre','date_de_creation','id_user')->get()->toArray();
        }catch (ModelNotFoundException $e){
            throw new ArticleNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function orderArticleByDateDesc(): array
    {
        try {
            return Article::select('id_article','titre','date_de_creation','id_user')->orderBy('date_de_creation', 'desc')->get()->toArray();
        }catch (ModelNotFoundException $e){
            throw new ArticleNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function orderArticleByDateAsc(): array
    {
        try {
            return Article::select('id_article','titre','date_de_creation','id_user')->orderBy('date_de_creation', 'asc')->get()->toArray();
        }catch (ModelNotFoundException $e){
            throw new ArticleNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function orderArticleByAuteur(): array
    {
        try {
            return Article::select('id_article','titre','date_de_creation','id_user')->orderBy('id_user')->get()->toArray();
        }catch (ModelNotFoundException $e){
            throw new ArticleNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function getArticlesByAuteur($id): array
    {
        try {
            return Article::select('id_article','titre','date_de_creation')->where('id_user', $id)->get()->toArray();
        }catch (ModelNotFoundException $e){
            throw new ArticleNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function getArticleById($id): array
    {
        try {
            return Article::where('id_article', $id)->first()->toArray();
        }catch (ModelNotFoundException $e){
            throw new ArticleNotFoundException($e->getMessage());
        }
    }
}