<?php
declare(strict_types=1);

namespace WebDir\core\appli\app\action;

use WebDir\core\appli\app\action\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDir\core\appli\core\domain\entities\Entree;
use WebDir\core\appli\core\domain\entities\Service;
use WebDir\core\appli\core\services\Entree\EntreeService;

class GetHomeAction extends AbstractAction {

    public string $template;
    private EntreeService $entreeService;

    public function __construct()
    {
        $this->template = 'home.twig';
        $this->entreeService = new EntreeService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response{
        //var_dump($_SESSION['user']);
        //die();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if($_POST['departement'] !== "tous"){
                $personnes = $this->entreeService->getEntreeByService($_POST['departement']);


                $entrees = Entree::all();
                $departments = [];
                foreach ($entrees as $entree) {
                    if($entree->department){
                        array_push($departments,Service::all()->toArray());
                    }
                }

                $session = $_SESSION['user'];
                $view = Twig::fromRequest($rq);
                return $view->render($rs, $this->template, ['personnes' => $personnes, 'department' => $departments]);
            }

        }

        $personnes = $this->entreeService->getEntree();
        usort($personnes, function($a, $b) {
            return strcmp($a['lastName'], $b['lastName']);
        });

        $entrees = Entree::all();
        $departments = [];
        foreach ($entrees as $entree) {
            if($entree->department){
                array_push($departments,Service::all()->toArray());
            }
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['personnes' => $personnes, 'department' => $departments]);
    }
}
