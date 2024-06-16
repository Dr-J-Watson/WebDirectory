<?php

namespace WebDir\core\appli\core\services\auth;

use WebDir\core\appli\core\domain\entities\User;

interface AuthServiceInterface {

    public function register(string $user_id, string $password): string;
    public function byCredentials(string $user_id, string $password): bool;
    public function getUser(string $email): array;
    
}