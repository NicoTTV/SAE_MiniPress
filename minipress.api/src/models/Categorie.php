<?php

declare(strict_types=1);

namespace minipress\api\models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Categorie extends Eloquent
{
    protected $table = "categorie";
    protected $primaryKey = "id_categorie";
    public $timestamps = false;
    public $incrementing = false;
}