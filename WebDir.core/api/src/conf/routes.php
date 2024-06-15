<?php
declare(strict_types=1);


use WebDir\core\api\app\actions\GetServicesAction;
use WebDir\core\api\app\actions\GetEntreesAction;
use WebDir\core\api\app\actions\GetEtreeByIdAction;
use WebDir\core\api\app\actions\GetEntreesByServiceIdAction;


return function(\Slim\App $app): \Slim\App {

    $app->get('/api/services[/]', GetServicesAction::class)->setName('services');

    $app->get('/api/entrees[/]', GetEntreesAction::class)->setName('entrees');

    $app->get('/api/entrees/{id}[/]', GetEtreeByIdAction::class)->setName('entrees_by_id');

    $app->get('/api/services/{id}/entrees[/]', GetEntreesByServiceIdAction::class)->setName('entrees_by_service_id');

    return $app;

};
