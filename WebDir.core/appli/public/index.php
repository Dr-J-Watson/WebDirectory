<?php
declare(strict_types=1);

use WebDir\core\appli\infrastructure\Eloquent;

require_once __DIR__ . '/../src/vendor/autoload.php';

Eloquent::init(__DIR__ . '/../src/conf/webdir.db.conf.ini');

$app = require_once __DIR__ . '/../src/conf/boostrap.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$app->run();