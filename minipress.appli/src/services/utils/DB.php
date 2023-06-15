<?php

namespace minipress\app\services\utils;

use Illuminate\Database\Capsule\Manager;

class DB extends Manager
{
    public static function initConnection(): void
    {
        $db = new Manager();
        $db->addConnection(parse_ini_file(__DIR__.'/../../conf/gift.db.conf.ini'));
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}