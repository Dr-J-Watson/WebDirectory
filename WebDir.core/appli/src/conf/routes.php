<?php
declare(strict_types=1);


use WebDir\core\appli\app\action\GetAddDepartementForm;
use WebDir\core\appli\app\action\GetAddEntreeForm;
use WebDir\core\appli\app\action\GetHomeAction;
use WebDir\core\appli\app\action\PostAddDepartement;
use WebDir\core\appli\app\action\PostAddEntree;

return function (\Slim\App $app): \Slim\App {

    // Page d'accueil
    $app->get('/',
        GetHomeAction::class
        )->setName('/');

    // Page formulaire ajout d'une personne dans l'annuaire
    $app->get('/add/personne', GetAddEntreeForm::class)
        ->setName('addPersonne');

    $app->get('/add/departement', GetAddDepartementForm::class)
        ->setName('addDepartement');

    // Ajout bd
    $app->post('/addbd/personne', PostAddEntree::class)
        ->setName('addPersonnePost');

    $app->post('/addbd/departement', PostAddDepartement::class)
        ->setName('addDepartementPost');

    return $app;
};
