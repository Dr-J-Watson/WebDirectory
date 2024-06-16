<?php

namespace WebDir\core\appli\core\services\Entree;

class EntreeServiceNotFoundException extends \Exception{
    public function __construct($message){
        parent::__construct($message);
    }
}