<?php

namespace WebDir\core\appli\app\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\appli\app\action\AbstractAction;
use WebDir\core\appli\core\services\departement\ServicesService;

class PostAddService extends AbstractAction{

    private ServicesService $departementService;

    public function __construct(){
        $this->departementService = new ServicesService();
    }
    function __invoke(Request $rq, Response $rs, $args): Response{
        try{
            $departement = $rq->getParsedBody();
            $departement['etage'] = (int)$departement['etage'];

            if ($departement['name'] !== filter_var($departement['name'], FILTER_SANITIZE_SPECIAL_CHARS) ||
                $departement['etage'] < 0 ||
                $departement['desc'] !== filter_var($departement['desc'], FILTER_SANITIZE_SPECIAL_CHARS))
            {
                throw new \Exception("Erreur de saisie");
            }

            $data = [
                'name' => $departement['name'],
                'etage' => $departement['etage'],
                'desc' => $departement['desc']
            ];

            $this->departementService->addDepartement($data);
            return $rs->withStatus(302)->withHeader('Location', '/');

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }
}