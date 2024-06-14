<?php
declare(strict_types=1);


use WebDir\core\api\app\actions\GetBoxAction;
use WebDir\core\api\app\actions\GetCategoriesAction;
use WebDir\core\api\app\actions\GetPrestationsAction;


return function(\Slim\App $app): \Slim\App {

    $app->get('/api/services[/]', GetPrestationsAction::class)->setName('services');

    $app->get('/api/entrees[/]', GetCategoriesAction::class)->setName('entrees');

    $app->get('/api/entrees/{id}[/]', GetBoxAction::class)->setName('entrees_by_id');

    return $app;

};
