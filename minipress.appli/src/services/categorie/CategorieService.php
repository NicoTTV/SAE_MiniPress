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
    public function getAllCategories():array
    {
        try {
            return Categorie::all()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new CategorieNotFoundException($e->getMessage());
        }
    }

    public function addCategories(Array $pack):String
    {
        $catego = Categorie::all();
        $nomb = $catego->pluck('id-categorie')->sortBy('id-categorie');
        $idLibre = 0;

        foreach ($nomb as $element) {
            if($element==$idLibre){
            $idLibre = $element+1;
            }
        }
        $catego2 = new Categorie();
        $catego2->setAttribute('id-categorie', $idLibre);
        $catego2->setAttribute('titre', $pack[0]);
        $catego2->setAttribute('description', $pack[1]);
        $catego2->setAttribute('created_at', new DateTime());
        if ($catego2->save()) {
            return "validated";
        } else {
            return "wrong";
        }
    }

    public function getIdFromTitre(String $titre):Int{
        $beta = Categorie::where('titre', $titre)->value('id-categorie');
        return $beta;
    }
}