<?php

namespace minipress\api\services\categorie;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use minipress\api\models\Categorie;
use minipress\api\services\exceptions\CategorieNotFoundException;

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
}