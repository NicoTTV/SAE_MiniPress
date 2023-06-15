<?php

use minipress\api\services\utils\DB;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true,false,false);
$twig = Twig::create('../src/templates',['cache'=>'cache/','auto_reload'=>true]);
$app->add(TwigMiddleware::create($app,$twig));
DB::initConnection();
return $app;