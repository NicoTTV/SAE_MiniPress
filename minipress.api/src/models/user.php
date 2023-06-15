<?php

declare(strict_types=1);

namespace models;

use Illuminate\Database\Eloquent\Model as Eloquent;

// Inclure les fichiers nécessaires pour Eloquent
require_once __DIR__ . '/../vendor/autoload.php';
class User extends Eloquent
{
    protected $table = "user";
    protected $primaryKey = "id_user";
    public $timestamps = false;
    public $incrementing = false;
}