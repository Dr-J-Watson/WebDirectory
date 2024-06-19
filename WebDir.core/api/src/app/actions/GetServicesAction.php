<?php

namespace WebDir\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\api\core\services\service\ServiceService;
use WebDir\core\api\core\services\service\ServiceServiceInterface;

use WebDir\core\api\app\utils\CorsUtility;

class GetServicesAction extends AbstractAction
{
    private ServiceServiceInterface $serviceService;

    public function __construct()
    {
        $this->serviceService = new ServiceService();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {


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

        $rs = CorsUtility::handle($rq, $rs, $responseContent);

        return $rs;
    }
}