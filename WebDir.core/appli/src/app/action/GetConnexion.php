<?php

namespace WebDir\core\appli\app\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDir\core\appli\app\action\AbstractAction;

class GetConnexion extends AbstractAction{

    function __invoke(Request $rq, Response $rs, $args): Response{

        $view = Twig::fromRequest($rq);

        return $view->render($rs, 'Connexion.twig');
    }
}