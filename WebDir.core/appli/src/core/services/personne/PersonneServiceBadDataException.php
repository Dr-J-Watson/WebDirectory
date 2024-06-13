<?php

namespace WebDir\core\appli\core\services\personne;

class PersonneServiceBadDataException extends \Exception{

    public function __construct($message){
        parent::__construct($message);
    }
}