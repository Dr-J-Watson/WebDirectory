<?php

namespace WebDir\core\appli\app\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\appli\app\action\AbstractAction;
use WebDir\core\appli\core\services\Entree\EntreeService;

class PostAddEntree extends AbstractAction{

    private EntreeService $personneService;

    public function __construct(){
        $this->personneService = new EntreeService();
    }
    function __invoke(Request $rq, Response $rs, $args): Response{

        try{
            $personne = $rq->getParsedBody();
            $uploaddir = __DIR__ . '/../../../html/assets/image/';
            $uploadfile = $uploaddir . basename($_FILES['image']['name']);

            if($personne['lastName'] !== filter_var($personne['lastName'], FILTER_SANITIZE_SPECIAL_CHARS) ||
                $personne['firstName'] !== filter_var($personne['firstName'], FILTER_SANITIZE_SPECIAL_CHARS ) ||
                $personne['numBureau'] !== filter_var($personne['numBureau'], FILTER_SANITIZE_SPECIAL_CHARS ) ||
                !filter_var($personne['email'], FILTER_VALIDATE_EMAIL ))
            {
                throw new \Exception("Erreur de saisie");
            }

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                throw new \Exception("Erreur load image");
            }

            $data = [
                'lastName' => $personne['lastName'],
                'firstName' => $personne['firstName'],
                'numBureau' => $personne['numBureau'],
                'email' => $personne['email'],
                'telFixe' => $personne['telFixe'],
                'telMobile' => $personne['telMobile'],
                'image' => basename($_FILES['image']['name']),
            ];

            $this->personneService->addEntree($data);
            return $rs->withStatus(302)->withHeader('Location', '/');

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }
}