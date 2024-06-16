<?php

namespace WebDir\core\appli\core\services\Entree;

class EntreeServiceBadDataException extends \Exception{

    public function __construct($message){
        parent::__construct($message);
    }
}