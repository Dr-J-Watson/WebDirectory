<?php

namespace WebDir\core\appli\app\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDir\core\appli\app\action\AbstractAction;

class GetAddServiceForm extends AbstractAction
{

    function __invoke(Request $rq, Response $rs, $args): Response{
        if(!isset($_SESSION['user'])){
            return $rs->withStatus(302)->withHeader('Location', '/');
        }
        $view = Twig::fromRequest($rq);

        return $view->render($rs, 'FormAddService.twig');
    }
}