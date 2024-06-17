<?php

namespace WebDir\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\api\core\services\service\ServiceService;
use WebDir\core\api\core\services\service\ServiceServiceInterface;

class GetServicesAction extends AbstractAction
{
    private ServiceServiceInterface $serviceService;

    public function __construct()
    {
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

        $servicesData = $this->serviceService->getServices();

        $servicesFormatted = [];
        foreach ($servicesData as $service) {
            $servicesFormatted[] = [
                'service' => [
                    'id' => $service['id'],
                    'nom' => $service['nom'],
                    'etage' => $service['etage'],
                    'description' => $service['description']
                ],
                'links' => [
                    'collections' => [
                        'href' => '/api/services/' . $service['id'] . '/entrees'
                    ]
                ]
            ];
        }

        $responseContent = [
            'type' => 'services',
            'count' => count($servicesFormatted),
            'services' => $servicesFormatted
        ];

        $responseContentJson = json_encode($responseContent , JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $rs->getBody()->write($responseContentJson);

        return $rs;
    }
}