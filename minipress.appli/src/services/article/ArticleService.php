<?php

namespace minipress\app\services\article;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use minipress\app\models\Article;
use minipress\app\services\exceptions\ArticleNotFoundException;
use minipress\app\services\exceptions\BadDataArticelException;
use Ramsey\Uuid\Uuid;

class ArticleService
{
    /**
     * @throws ArticleNotFoundException
     */
    public function getArticles(): array
    {
        try {
            return Article::all()->toArray();
        }catch (ModelNotFoundException $e){
            throw new ArticleNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws ArticleNotFoundException
     * @throws BadDataArticelException
     */
    public function getArticleById(string $id): array
    {

        if (empty($id) || $id !== filter_var($id, FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
            throw new BadDataArticelException("Bad data : id");
        }

        try {
            return Article::findOrFail($id)->toArray();
        }catch (ModelNotFoundException $e){
            throw new ArticleNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws BadDataArticelException
     */
    public function createArticle(array $article, $uploadedFile): bool
    {

        if (empty($article['titre']) || $article['titre'] !== filter_var($article['titre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
            throw new BadDataArticelException("Bad data : title");
        }

        if (empty($article['contenu']) || $article['contenu'] !== filter_var($article['contenu'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
            throw new BadDataArticelException("Bad data : content");
        }

        if (empty($article['resume']) || $article['resume'] !== filter_var($article['resume'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
            throw new BadDataArticelException("Bad data : resume");
        }

        if (empty($article['categorie']) || $article['categorie'] !== filter_var($article['categorie'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
            throw new BadDataArticelException("Bad data : categorie");
        }

        if (isset($_SESSION['user'])) {
            $author = unserialize($_SESSION['user']);
            $article['id_user'] = $author[0]['id_user'];
        }
        $article['id_article'] = Uuid::uuid4()->toString();

        try {
            $date = new \DateTime(datetime: 'now', timezone: new \DateTimeZone('Europe/Paris'));
            $article['date'] = $date->format('y-m-d h-m-s');
        } catch (\Exception $e) {
            throw new BadDataArticelException("Bad data : date");
        }

        if ($uploadedFile !== null) {
            $directory = __DIR__ . '/../../../html/img';
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                if ($extension !== 'jpg' && $extension !== 'jpeg' && $extension !== 'png') {
                    throw new BadDataArticelException("Bad data : image");
                }
                $basename = bin2hex(random_bytes(8));
                $filename = sprintf('%s.%0.8s', $basename, $extension);

                $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
                $article['image'] = $filename;
            }
        }

        try {
            $newArticle = new Article($article);
            $newArticle->id_article = $article['id_article'];
            $newArticle->id_user = $article['id_user'];
            $newArticle->titre = $article['titre'];
            $newArticle->contenu = $article['contenu'];
            $newArticle->resume = $article['resume'];
            $newArticle->date_de_creation = $article['date'];
            $newArticle->image = $article['image'] ?? null;
            $newArticle->id_categorie = $article['categorie'];
            $newArticle->saveOrFail();
        } catch (\Throwable $e) {
            throw new BadDataArticelException("Error while creating article");
        }
        return true;
    }
}