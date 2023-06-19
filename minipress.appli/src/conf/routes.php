<?php

use minipress\app\actions\GetConnexionAction;
use minipress\app\actions\GetInscriptionAction;
use minipress\app\actions\GetMainAction;
use minipress\app\actions\PostConnexionAction;
use minipress\app\actions\PostInscriptionAction;
use minipress\app\actions\GetArticleAction;
use Slim\App;

return function (App $app) {
    $app->get('/',GetMainAction::class)->setName('home');
    $app->get('/connexion',GetConnexionAction::class)->setName('connexion');
    $app->post('/connexion',PostConnexionAction::class)->setName('connexion.post');
    $app->get('/inscription',GetInscriptionAction::class)->setName('inscription');
    $app->post('/inscription',PostInscriptionAction::class)->setName('inscription.post');
    $app->get('/article',GetArticleAction::class)->setName('article');
};