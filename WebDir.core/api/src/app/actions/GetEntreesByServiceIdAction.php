<?php

namespace WebDir\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\api\core\services\entree\EntreeService;
use WebDir\core\api\core\services\entree\EntreeServiceInterface;
use WebDir\core\api\core\services\service\ServiceService;
use WebDir\core\api\core\services\service\ServiceServiceInterface;

use WebDir\core\api\app\utils\CorsUtility;

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

        $sort = $rq->getQueryParams()['sort'] ?? null;
        $entreesData = $this->entreeService->getEntreesByServiceId($args['id'], $sort);

        $entreesFormatted = [];
        foreach ($entreesData as $entree) {
            $entreesFormatted[] = [
                'entree' => [
                    'lastName' => $entree['lastName'],
                    'firstName' => $entree['firstName'],
                    'services' => $this->serviceService->getNameServicesByEntreeId($entree['uuid'])

                ],   
                'links' => [
                    'self' => [
                        'href' => '/api/entrees/' . $entree['uuid']
                    ],
                    "collections" => $this->serviceService->getLinksToEntreesByServiceId($entree['uuid'])    
                ]         
            ];
        }

        $responseContent = [
            'type' => 'collections',
            //mettre le nom du service
            'service' => $this->serviceService->getNameServiceById($args['id']),
            'count' => count($entreesFormatted),
            'entrees' => $entreesFormatted
        ];

        $rs = CorsUtility::handle($rq, $rs, $responseContent);

        return $rs;
    }  
}