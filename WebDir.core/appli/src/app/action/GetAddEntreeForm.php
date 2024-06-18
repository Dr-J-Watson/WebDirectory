<?php

namespace WebDir\core\appli\app\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDir\core\appli\app\action\AbstractAction;
use WebDir\core\appli\core\services\service\ServicesService;
use WebDir\core\appli\core\services\service\ServicesServiceInterface;

class GetAddEntreeForm extends AbstractAction{
    private ServicesServiceInterface $serviceService;

    public function __construct(){
        $this->serviceService = new ServicesService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response{

        if(!isset($_SESSION['user'])){
            return $rs->withStatus(302)->withHeader('Location', '/');
        }
        $dep = $this->serviceService->getServices()->toArray();
        
        $view = Twig::fromRequest($rq);

        return $view->render($rs, 'FormAddEntree.twig', ['department' => $dep]);
    }
}