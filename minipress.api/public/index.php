<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/vendor/autoload.php';

/* Application bootstrap */
$app = require_once __DIR__ . '/../src/conf/bootstrap.php';

/* Routes loading */
(require_once __DIR__ . '/../src/conf/route.php')($app);

$app->run();
