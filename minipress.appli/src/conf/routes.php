<?php

use minipress\app\actions\GetConnexionAction;
use minipress\app\actions\GetMainAction;
use minipress\app\actions\PostConnexionAction;
use Slim\App;

return function (App $app) {
    $app->get('/',GetMainAction::class)->setName('home');
    $app->get('/connexion',GetConnexionAction::class)->setName('connexion');
    $app->post('/connexion',PostConnexionAction::class)->setName('connexion.post');
};