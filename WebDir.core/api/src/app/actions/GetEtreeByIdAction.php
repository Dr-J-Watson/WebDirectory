<?php

namespace WebDire\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDire\core\api\core\services\entree\EntreeService;
use WebDire\core\api\core\services\entree\EntreeServiceInterface;
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

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $entreeData = $this->entreeService->getEntreeById($args['id']);
        $entreeFormatted = [
            'entree' => [
                'uuid' => $entreeData['uuid'],
                'lastName' => $entreeData['lastName'],
                'firstName' => $entreeData['firstName'],
                'numBureau' => $entreeData['numBureau'],
                'telFixe' => $entreeData['telFixe'],
                'telMobile' => $entreeData['telMobile'],
                'email' => $entreeData['email'],
                'image' => $entreeData['image']
            ],
            'links' => [
                $this->serviceService->getLinksToServicesByEntreeId($entreeData['uuid'])
            ]
        ];

        $responseContent = [
            'type' => 'resource',
            'entree' => $entreeFormatted
        ];

        $responseContentJson = json_encode($responseContent);
        $response->getBody()->write($responseContentJson);

        // Retourne la réponse avec l'en-tête Content-Type JSON
        return $rs->withHeader('Content-Type', 'application/json');

        return $response;
    }
}

