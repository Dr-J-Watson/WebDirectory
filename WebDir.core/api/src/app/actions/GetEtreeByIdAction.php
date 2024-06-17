<?php

namespace WebDir\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\api\core\services\entree\EntreeService;
use WebDir\core\api\core\services\entree\EntreeServiceInterface;
use WebDir\core\api\core\services\service\ServiceService;
use WebDir\core\api\core\services\service\ServiceServiceInterface;

class GetEtreeByIdAction extends AbstractAction
{
    private EntreeServiceInterface $entreeService;
    private ServiceServiceInterface $serviceService;

    public function __construct()
    {
        $this->entreeService = new EntreeService();
        $this->serviceService = new ServiceService();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {

        // Ajouter les en-têtes CORS
        $rs = $rs->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->withHeader('Content-Type', 'application/json');

        // Vérifier si la requête est une requête OPTIONS (pré-vol)
        if ($rq->getMethod() === 'OPTIONS') {
            return $rs->withStatus(204); // No Content
        }

        $entree = $this->entreeService->getEntreeById($args['id']);
        $entreeFormatted = [

            'uuid' => $entree['uuid'],
            'lastName' => $entree['lastName'],
            'firstName' => $entree['firstName'],
            'numBureau' => $entree['numBureau'],
            'fonction' => $entree['fonction'],
            'telFixe' => $entree['telFixe'],
            'telMobile' => $entree['telMobile'],
            'email' => $entree['email'],
            'image' => $entree['image'],
            //la liste des noms des services de l'entrée
            'services' => $this->serviceService->getNameServicesByEntreeId($entree['uuid'])
        ];

        $responseContent = [
            'type' => 'resource',
            'entree' => $entreeFormatted,
            'links' => [
                "collections" => $this->serviceService->getLinksToEntreesByServiceId($entree['uuid']) 
            ]
        ];

        $responseContentJson = json_encode($responseContent , JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $rs->getBody()->write($responseContentJson);

        return $rs;
    }
}

