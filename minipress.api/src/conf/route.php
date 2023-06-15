<?php


use minipress\api\actions\ArticleAction;
use minipress\api\actions\CategorieAction;
use Slim\App;

return function (App $app) {
    $app->get('/api/categories', CategorieAction::class);
    $app->get('/api/articles', ArticleAction::class);
    //$app->post('/formule',test::class);
};
