<?php

namespace WebDir\core\appli\app\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\appli\app\action\AbstractAction;
use WebDir\core\appli\core\services\Entree\EntreeService;
use WebDir\core\appli\core\services\service\ServicesService;

class PostAddEntree extends AbstractAction{

    private EntreeService $personneService;
    private ServicesService $servicesService;

    public function __construct(){
        $this->personneService = new EntreeService();
        $this->servicesService = new ServicesService();
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

            $dep = [];
            if (isset($_POST['departement'])) {
                $selectedOptions = $_POST['departement']; // $selectedOptions est un tableau des valeurs sélectionnées
                foreach ($selectedOptions as $option) {
                    $dep[] = $option;
                }
            }

            if(isset($personne['image'])){
                $uploaddir = __DIR__ . '/../../../html/assets/image/';
                $uploadfile = $uploaddir . basename($_FILES['image']['name']);
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    throw new \Exception("Erreur load image");
                }
                $personne['image'] = basename($_FILES['image']['name']);
            }


            $data = [
                'lastName' => $personne['lastName'],
                'firstName' => $personne['firstName'],
                'numBureau' => $personne['numBureau'],
                'email' => $personne['email'],
                'telFixe' => $personne['telFixe'],
                'telMobile' => $personne['telMobile'],
                'image' => isset($personne['image']) ? $personne['image'] : '',
            ];


            $dep = $this->servicesService->getDepartements($personne['departement'])->toArray();
            $this->personneService->addEntree($data, $dep);
            return $rs->withStatus(302)->withHeader('Location', '/home');

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }
}