<?php

namespace WebDir\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\api\core\services\entree\EntreeService;
use WebDir\core\api\core\services\entree\EntreeServiceInterface;
use WebDir\core\api\core\services\service\ServiceService;
use WebDir\core\api\core\services\service\ServiceServiceInterface;

use WebDir\core\api\app\utils\CorsUtility;

class SearchEntreesInServiceAction extends AbstractAction
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


        $query = $rq->getQueryParams()['q'] ?? null;
        $sort = $rq->getQueryParams()['sort'] ?? null;
        $entreesData = $this->entreeService->searchEntreesInService($args['id'], $query, $sort);

        $entreesFormatted = [];
        foreach ($entreesData as $entree) {
            $entreesFormatted[] = [
                'entree' => [
                    'uuid' => $entree['uuid'],
                    'lastName' => $entree['lastName'],
                    'firstName' => $entree['firstName'],
                    'numBureau' => $entree['numBureau'],
                    'fonction' => $entree['fonction'],
                    'telFixe' => $entree['telFixe'],
                    'telMobile' => $entree['telMobile'],
                    'email' => $entree['email'],
                    'image' => $entree['image'],
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
            'count' => count($entreesFormatted),
            'entrees' => $entreesFormatted
        ];

        $rs = CorsUtility::handle($rq, $rs, $responseContent);

        return $rs;
    }
}