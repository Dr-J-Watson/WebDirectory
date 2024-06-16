<?php
namespace WebDir\core\appli\app\providers\auth;

use Exception;
use WebDir\core\appli\app\providers\auth\AuthProviderInterface;
use WebDir\core\appli\core\services\auth\AuthService;

class SessionAuthProvider implements AuthProviderInterface{

    private AuthService $authService;
    public function __construct(){
        $this->authService = new AuthService();
    }

    public function register(string $email, string $password): void{
        $this->authService->register($email, $password);
    }

    public function signin(string $email, string $password): void{
        if(!$this->authService->byCredentials($email, $password)){
            throw new Exception('Identifiant ou mot de passe incorrect');
        }
        $user = $this->authService->getUser($email);

        $_SESSION['user'] = $user;
    }

    public function signout(): void{
        session_destroy();
    }

    public function isSignedIn(): bool{
        return isset($_SESSION['user']);
    }

    public function getSignedInUser(): array{
        return $_SESSION['user'];
    }
}