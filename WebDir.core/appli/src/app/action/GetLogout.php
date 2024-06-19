<?php

namespace WebDir\core\appli\app\action;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\appli\app\action\AbstractAction;
use WebDir\core\appli\app\providers\auth\AuthProviderInterface;
use WebDir\core\appli\app\providers\auth\SessionAuthProvider;

class GetLogout extends AbstractAction
{

    public AuthProviderInterface $authProvider;

    public function __construct()
    {
        $this->authProvider = new SessionAuthProvider();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $this->authProvider->signout();

        return $rs->withHeader('Location', '/')->withStatus(302);
    }
}