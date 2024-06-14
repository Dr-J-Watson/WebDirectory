<?php
declare(strict_types=1);

use WebDir\core\api\infrastructure\Eloquent;

require_once __DIR__ . '/../src/vendor/autoload.php';

/* application boostrap */
$app = require_once __DIR__ . '/../src/conf/bootstrap.php';
Eloquent::init(__DIR__ . '/../src/conf/webdir.db.conf.ini');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$app->run();



