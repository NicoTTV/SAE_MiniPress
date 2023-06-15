<?php

declare(strict_types=1);

namespace minipress\app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class User extends Eloquent
{
    protected $table = "user";
    protected $primaryKey = "id_user";
    public $timestamps = false;
}