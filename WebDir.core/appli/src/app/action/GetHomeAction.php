<?php
declare(strict_types=1);

namespace WebDir\core\appli\app\action;

use WebDir\core\appli\app\action\AbstractAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDir\core\appli\core\domain\entities\Entree;
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
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $personnes = $this->entreeService->getEntreeByService($_POST['departement']);
            usort($personnes, function($a, $b) {
                return strcmp($a['lastName'], $b['lastName']);
            });

            $entrees = Entree::all();
            $departments = [];
            foreach ($entrees as $entree) {
                if($entree->department){
                    array_push($departments,$entree->department->toArray());
                }
            }

            $view = Twig::fromRequest($rq);
            return $view->render($rs, $this->template, ['personnes' => $personnes, 'department' => $departments]);
        }

        $personnes = $this->entreeService->getEntree();
        usort($personnes, function($a, $b) {
            return strcmp($a['lastName'], $b['lastName']);
        });

        $entrees = Entree::all();
        $departments = [];
        foreach ($entrees as $entree) {
            if($entree->department){
                array_push($departments,$entree->department->toArray());
            }
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['personnes' => $personnes, 'department' => $departments]);
    }
}
