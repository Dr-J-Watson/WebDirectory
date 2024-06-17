<?php
declare(strict_types=1);


use WebDir\core\appli\app\action\GetAddServiceForm;
use WebDir\core\appli\app\action\GetAddEntreeForm;
use WebDir\core\appli\app\action\GetConnexion;
use WebDir\core\appli\app\action\GetHomeAction;
use WebDir\core\appli\app\action\PostAddService;
use WebDir\core\appli\app\action\PostAddEntree;
use WebDir\core\appli\app\action\PostConnexionAction;

return function (\Slim\App $app): \Slim\App {

    // Page d'accueil
    $app->get('/',
        GetConnexion::class
        )->setName('/');

    // Page formulaire ajout d'une Entree dans l'annuaire
    $app->get('/add/Entree', GetAddEntreeForm::class)
        ->setName('addPersonne');

    $app->get('/add/service', GetAddServiceForm::class)
        ->setName('addDepartement');

    // Ajout bd
    $app->post('/addbd/Entree', PostAddEntree::class)
        ->setName('addPersonnePost');

    $app->post('/addbd/service', PostAddService::class)
        ->setName('addDepartementPost');

    // Connexion
    $app->get('/connexion', GetConnexion::class)
        ->setName('connexion');
    $app->post('/connexion', PostConnexionAction::class)
        ->setName('connexion');

    // Affichage liste entree
    $app->get('/home', GetHomeAction::class)->setName('home');

    return $app;
};
