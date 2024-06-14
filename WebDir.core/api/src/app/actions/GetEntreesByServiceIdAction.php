<?php

namespace WebDir\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\api\core\services\entree\EntreeService;
use WebDir\core\api\core\services\entree\EntreeServiceInterface;
use WebDir\core\api\core\services\service\ServiceService;
use WebDir\core\api\core\services\service\ServiceServiceInterface;

class GetEntreesByServiceIdAction extends AbstractAction
{
    private EntreeServiceInterface $entreeService;
    private ServiceServiceInterface $serviceService;

    // Constructeur initialisant le service de gestion des
    public function __construct()
    {
        $this->entreeService = new EntreeService();
        $this->serviceService = new ServiceService();
    }

    // Méthode invoquée lorsque l'action est appelée
    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        // Récupération des données des entrées
        $entreesData = $this->entreeService->getEntreesByServiceId($args['id']);

        // Formatage des données des entrées pour l'inclusion dans la réponse
        $entreesFormatted = [];
        foreach ($entreesData as $entree) {
            $entreesFormatted[] = [
                'entree' => [
                    'lastName' => $entree['lastName'],
                    'firstName' => $entree['firstName'],
                    //la liste des services de l'entrée
                    'services' => $this->serviceService->getServicesByEntreeId($entree['uuid'])

                ],   
                'links' => [
                    'self' => [
                        'href' => '/api/entrees/' . $entree['uuid']
                    ],
                    $this->serviceService->getLinksToServicesByEntreeId($entree['uuid'])    
                ]         
            ];
        }
    }  
}