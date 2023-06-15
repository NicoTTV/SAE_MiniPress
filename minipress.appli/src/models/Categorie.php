<?php

declare(strict_types=1);

namespace minipress\app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Categorie extends Eloquent
{
    protected $table = "categorie";
    protected $primaryKey = "id_categorie";
    public $timestamps = false;
}