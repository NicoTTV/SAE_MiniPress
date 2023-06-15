<?php

use actions\CategorieAction;
use actions\ArticleAction;

return function (\Slim\App $app) {
    $app->get('/api/categories', CategorieAction::class);
    $app->get('/api/articles', ArticleAction::class);
    //$app->post('/formule',test::class);
};
