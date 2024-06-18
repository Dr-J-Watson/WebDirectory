<?php
declare(strict_types=1);


use WebDir\core\api\app\actions\GetServicesAction;
use WebDir\core\api\app\actions\GetEntreesAction;
use WebDir\core\api\app\actions\GetEtreeByIdAction;
use WebDir\core\api\app\actions\GetEntreesByServiceIdAction;
use WebDir\core\api\app\actions\SearchEntreesAction;
use WebDir\core\api\app\actions\SearchEntreesInServiceAction;


return function(\Slim\App $app): \Slim\App {

    $app->get('/api/services[/]', GetServicesAction::class)->setName('services');

    $app->get('/api/entrees[/]', GetEntreesAction::class)->setName('entrees');

    $app->get('/api/entrees/search[/]', SearchEntreesAction::class)->setName('search_entrees');

    $app->get('/api/services/{id}/entrees/search[/]', SearchEntreesInServiceAction::class)->setName('search_entrees_in_service');

    $app->get('/api/entrees/{id}[/]', GetEtreeByIdAction::class)->setName('entrees_by_id');

    $app->get('/api/services/{id}/entrees[/]', GetEntreesByServiceIdAction::class)->setName('entrees_by_service_id');

    return $app;

};
