<?php

namespace minipress\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

abstract class AbstractAction
{
    abstract public function __invoke(Request $rq, Response $rs, array $args): Response;
}