<?php

use actions\CategorieAction;
use actions\ArticleAction;
use actions\CateArctAction;
use actions\ArticleCompletAction;
use actions\ArticleAuteurAction;

return function (\Slim\App $app) {
    $app->get('/api/categories', CategorieAction::class);
    $app->get('/api/categories/{id}/articles', CateArctAction::class);
    $app->get('/api/articles', ArticleAction::class);
    $app->get('/api/articles/{id}', ArticleCompletAction::class);
    $app->get('/api/auteurs/{id}/articles', ArticleAuteurAction::class);
    //$app->post('/formule',test::class);
};
