<?php

use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../actions/CategorieAction.php';


// Configuration de la connexion à la base de données
$host = 'db';
$database = 'minipress';
$username = 'user';
$password = 'passwd';

// Initialiser Eloquent
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => $host,
    'database' => $database,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true,false,false);
$twig = \Slim\Views\Twig::create('../src/templates',['cache'=>'cache/','auto_reload'=>true]);
$app->add(\Slim\Views\TwigMiddleware::create($app,$twig));
return $app;