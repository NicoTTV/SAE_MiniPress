<?php

namespace minipress\app\services\categorie;

use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use minipress\app\models\Categorie;
use minipress\app\services\exceptions\CategorieNotFoundException;

class CategorieService
{
    /**
     * @throws CategorieNotFoundException
     */
    public function getAllCategories(): array
    {
        try {
            return Categorie::all()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new CategorieNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws CategorieNotFoundException
     */
    public function addCategories(array $pack): string
    {
        try {
            $catego = Categorie::all();
            $nomb = $catego->pluck('id_categorie')->toArray();
            $idLibre = 0;
            sort($nomb);
            foreach ($nomb as $num) {
                if ($num == $idLibre) {
                    $idLibre++;
                }
            }
        } catch (\Exception|\Throwable $e) {
            throw new CategorieNotFoundException($e->getMessage());
        }
        try {
            $catego2 = new Categorie();
            $catego2->setAttribute('id_categorie', $idLibre);
            $catego2->setAttribute('titre', $pack[0]);
            $catego2->setAttribute('description', $pack[1]);
            $catego2->setAttribute('created_at', new DateTime());
            if ($catego2->saveOrFail()) {
                return "Catégorie créé";
            } else {
                return "Erreur de création";
            }
        } catch (\Exception|\Throwable $e) {
            throw new CategorieNotFoundException($e->getMessage());
        }

    }

    /**
     * @throws CategorieNotFoundException
     */
    public function getIdFromTitre(string $titre): int
    {
        try {
            return Categorie::where('titre', $titre)->value('id_categorie');
        } catch (ModelNotFoundException $e) {
            throw new CategorieNotFoundException($e->getMessage());
        }
    }
}