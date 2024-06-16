<?php

namespace WebDir\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\api\core\services\entree\EntreeService;
use WebDir\core\api\core\services\entree\EntreeServiceInterface;
use WebDir\core\api\core\services\service\ServiceService;
use WebDir\core\api\core\services\service\ServiceServiceInterface;

class SearchEntreesAction extends AbstractAction
{
    private EntreeServiceInterface $entreeService;
    private ServiceServiceInterface $serviceService;

    public function __construct()
    {
        $this->entreeService = new EntreeService();
        $this->serviceService = new ServiceService();
    }

    /*
    recherche d’une entrée –il est possible de rechercher des entrées répondant à un critère de
    recherche. Le critère est une chaine de caractères comparées au nom. Toutes les entrées dont le
    nom contient cette chaine sont ajoutées au résultat. au format JSON à l’url
    /api/entrees/search?q=abcd
    */
    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $query = $rq->getQueryParams()['q'];
        $sort = $rq->getQueryParams()['sort'] ?? null;
        $entreesData = $this->entreeService->searchEntrees($query , $sort);

        $entreesFormatted = [];
        foreach ($entreesData as $entree) {
            $entreesFormatted[] = [
                'entree' => [
                    'uuid' => $entree['uuid'],
                    'lastName' => $entree['lastName'],
                    'firstName' => $entree['firstName'],
                    'numBureau' => $entree['numBureau'],
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

        $responseContentJson = json_encode($responseContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $rs->getBody()->write($responseContentJson);
        return $rs->withHeader('Content-Type', 'application/json','Access-Control-Allow-Origin', '*');
    }
}