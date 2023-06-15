<?php

declare(strict_types=1);

namespace models;

use Illuminate\Database\Eloquent\Model as Eloquent;

// Inclure les fichiers nécessaires pour Eloquent
require_once __DIR__ . '/../vendor/autoload.php';
class Article extends Eloquent
{
        protected $table = "article";
    protected $primaryKey = "id_article";
    public $timestamps = false;
    public $incrementing = false;
}