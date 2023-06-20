<?php

use minipress\api\actions\ArticleAction;
use minipress\api\actions\CategorieAction;
use minipress\api\actions\CateArctAction;
use minipress\api\actions\ArticleCompletAction;
use minipress\api\actions\ArticleAuteurAction;
use minipress\api\actions\UserAction;
use Slim\App;

return function (App $app) {
    $app->get('/api/categories', CategorieAction::class);
    $app->get('/api/categories/{id}/articles', CateArctAction::class);
    $app->get('/api/articles', ArticleAction::class);
    $app->get('/api/articles/{id}', ArticleCompletAction::class);
    $app->get('/api/auteurs/{id}/articles', ArticleAuteurAction::class);
    $app->get('/api/user',UserAction::class);
};
