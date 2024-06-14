<?php

namespace WebDir\core\appli\app\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\appli\app\action\AbstractAction;
use WebDir\core\appli\core\services\personne\EntreeService;

class PostAddEntree extends AbstractAction{

    private EntreeService $personneService;

    public function __construct(){
        $this->personneService = new EntreeService();
    }
    function __invoke(Request $rq, Response $rs, $args): Response{
        try{
            $personne = $rq->getParsedBody();

            if($personne['lastName'] !== filter_var($personne['lastName'], FILTER_SANITIZE_SPECIAL_CHARS) ||
                $personne['firstName'] !== filter_var($personne['firstName'], FILTER_SANITIZE_SPECIAL_CHARS ) ||
                $personne['numBureau'] !== filter_var($personne['numBureau'], FILTER_SANITIZE_SPECIAL_CHARS ) ||
                !filter_var($personne['email'], FILTER_VALIDATE_EMAIL ))
            {
                throw new \Exception("Erreur de saisie");
            }


            $data = [
                'lastName' => $personne['lastName'],
                'firstName' => $personne['firstName'],
                'numBureau' => $personne['numBureau'],
                'email' => $personne['email'],
                'telFixe' => $personne['telFixe'],
                'telMobile' => $personne['telMobile'],
                'image' => ''
            ];

            $this->personneService->addPersonne($data);
            return $rs->withStatus(302)->withHeader('Location', '/');

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }
}