<?php

namespace WebDir\core\appli\core\services\auth;

use Exception;

class AuthServiceNotFoundException extends Exception {
        
        public function __construct($message) {
            parent::__construct($message);
        }
}