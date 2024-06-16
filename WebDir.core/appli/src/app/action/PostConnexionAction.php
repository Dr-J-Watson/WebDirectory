<?php
declare(strict_types=1);

namespace WebDir\core\appli\app\action;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use WebDir\core\appli\app\action\AbstractAction;
use WebDir\core\appli\app\providers\auth\AuthProviderInterface;
use WebDir\core\appli\app\providers\auth\SessionAuthProvider;
use WebDir\core\appli\core\services\auth\AuthServiceNotFoundException;

class PostConnexionAction extends AbstractAction {
    
    private SessionAuthProvider $authProvider;

    public function __construct()
    {
        $this->authProvider = new SessionAuthProvider();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            $body = $rq->getParsedBody();
            if ($body['email'] !== filter_var($body['email'], FILTER_SANITIZE_EMAIL)) {
                throw new \Exception('Erreur de saisie');
            }
            if ($body['password'] !== filter_var($body['password'], FILTER_SANITIZE_SPECIAL_CHARS)) {
                throw new \Exception('Erreur de saisie');
            }
            $user = $this->authProvider->signin($body['email'], $body['password']);           
        } catch (AuthServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }

        return $rs->withStatus(302)->withHeader('Location', '/home');
    }
}
