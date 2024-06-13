<?php
declare(strict_types=1);


use WebDir\core\appli\app\action\GetAddPersonneForm;
use WebDir\core\appli\app\action\GetHomeAction;
use WebDir\core\appli\app\action\PostAddPersonne;

return function (\Slim\App $app): \Slim\App {

    // Page d'accueil
    $app->get('/',
        GetHomeAction::class
        )->setName('/');

    // Page formulaire ajout d'une personne dans l'annuaire
    $app->get('/add/personne', GetAddPersonneForm::class)
        ->setName('addPersonne');

    // Ajout bd
    $app->post('/addbd/personne', PostAddPersonne::class)
        ->setName('addPersonnePost');

    return $app;
};
