<?php
declare(strict_types=1);


use WebDir\core\api\app\actions\GetServicesAction;
use WebDir\core\api\app\actions\GetEntreesAction;
use WebDir\core\api\app\actions\GetEtreeByIdAction;
use WebDir\core\api\app\actions\GetEntreesByServiceIdAction;
use WebDir\core\api\app\actions\SearchEntreesAction;


return function(\Slim\App $app): \Slim\App {

    $app->get('/api/services[/]', GetServicesAction::class)->setName('services');

    $app->get('/api/entrees[/]', GetEntreesAction::class)->setName('entrees');

    $app->get('/api/entrees/search[/]', SearchEntreesAction::class);

    $app->get('/api/entrees/{id}[/]', GetEtreeByIdAction::class)->setName('entrees_by_id');

    $app->get('/api/services/{id}/entrees[/]', GetEntreesByServiceIdAction::class)->setName('entrees_by_service_id');

    $app->get('/image/{nom}', function ($request, $response, $args) {
        $nom = $args['nom'];
        $image = file_get_contents(__DIR__ . '/../../public/assets/image/' . $nom);
        $response->write($image);
        return $response->withHeader('Content-Type', 'image/jpeg');
    });

    return $app;

};
