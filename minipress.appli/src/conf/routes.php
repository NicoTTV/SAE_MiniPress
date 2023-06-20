<?php

use minipress\app\actions\GetArticleFormAction;
use minipress\app\actions\GetConnexionAction;
use minipress\app\actions\GetInscriptionAction;
use minipress\app\actions\GetInscriptionByAdmin;
use minipress\app\actions\GetMainAction;
use minipress\app\actions\PostArticleFormAction;
use minipress\app\actions\PostConnexionAction;
use minipress\app\actions\PostDeconnexionAction;
use minipress\app\actions\PostDepublieArticleAction;
use minipress\app\actions\PostInscriptionAction;
use minipress\app\actions\GetArticleAction;
use minipress\app\actions\GetCategorieFormAction;
use minipress\app\actions\PostCategorieFormAction;
use minipress\app\actions\PostInscriptionByAdmin;
use minipress\app\actions\PostPubDepubArticleAction;
use Slim\App;

return function (App $app) {
    $app->get('/',GetMainAction::class)->setName('home');
    $app->get('/connexion',GetConnexionAction::class)->setName('connexion');
    $app->post('/connexion',PostConnexionAction::class)->setName('connexion.post');
    $app->get('/inscription',GetInscriptionAction::class)->setName('inscription');
    $app->get('/admin/user/add', GetInscriptionByAdmin::class)->setName('inscription.admin');
    $app->post('/admin/user/add', PostInscriptionByAdmin::class)->setName('inscription.admin.post');
    $app->post('/inscription',PostInscriptionAction::class)->setName('inscription.post');
    $app->get('/article',GetArticleAction::class)->setName('article');
    $app->get('/categorie',GetCategorieFormAction::class)->setName('categorie');
    $app->post('/categorie',PostCategorieFormAction::class)->setName('categorie');
    $app->get('/article/add',GetArticleFormAction::class)->setName('form.article');
    $app->post('/article/add',PostArticleFormAction::class)->setName('form.article.post');
    $app->post('/article/publie',PostPubDepubArticleAction::class)->setName('publie.post');
    $app->post('/article/depublie',PostDepublieArticleAction::class)->setName('depublie.post');
};