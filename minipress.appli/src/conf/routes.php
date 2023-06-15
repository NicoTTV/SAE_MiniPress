<?php

use minipress\app\actions\GetMainAction;
use Slim\App;

return function (App $app) {
    $app->get('/',GetMainAction::class)->setName('home');
};