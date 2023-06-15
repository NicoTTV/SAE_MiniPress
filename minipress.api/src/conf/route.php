<?php

use actions\CategorieAction;
use actions\ArticleAction;
use actions\CateArctAction;
use actions\ArticleCompletAction;
use actions\ArticleAuteurAction;

use minipress\api\actions\ArticleAction;
use minipress\api\actions\CategorieAction;
use Slim\App;

return function (App $app) {
    $app->get('/api/categories', CategorieAction::class);
    $app->get('/api/categories/{id}/articles', CateArctAction::class);
    $app->get('/api/articles', ArticleAction::class);
    $app->get('/api/articles/{id}', ArticleCompletAction::class);
    $app->get('/api/auteurs/{id}/articles', ArticleAuteurAction::class);
    //$app->post('/formule',test::class);
};
