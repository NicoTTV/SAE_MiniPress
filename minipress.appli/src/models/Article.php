<?php

declare(strict_types=1);

namespace minipress\app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Article extends Eloquent
{
        protected $table = "article";
    protected $primaryKey = "id_article";
    public $timestamps = false;
    public $incrementing = false;
}