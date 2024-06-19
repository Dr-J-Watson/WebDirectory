<?php

namespace WebDir\core\appli\app\action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\appli\app\action\AbstractAction;
use WebDir\core\appli\core\services\user\UserService;
use WebDir\core\appli\core\services\user\UserServiceInterface;

class PostAddUser extends AbstractAction{

    private UserServiceInterface $userService;

    public function __construct(){
        $this->userService = new UserService();
    }

    function __invoke(Request $rq, Response $rs, $args): Response{

        $newUser = $rq->getParsedBody();
        if(!$this->userService->inBD($newUser['email'])){
            if(filter_var($newUser['email'], FILTER_VALIDATE_EMAIL)){

                $data = [
                    'id' => $newUser['email'],
                    'pwd' => password_hash($newUser['password'], PASSWORD_DEFAULT, ["cost" => 12])
                ];

                $this->userService->addUser($data);
                return $rs->withStatus(302)->withHeader('Location', '/home');
            }
            return $rs->withStatus(302)->withHeader('Location', '/add/user');
        }

        return $rs->withStatus(302)->withHeader('Location', '/home');
    }
}