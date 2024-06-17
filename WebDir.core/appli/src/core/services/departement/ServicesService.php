<?php

namespace WebDir\core\appli\core\services\service;

use WebDir\core\appli\core\domain\entities\Service;
use WebDir\core\appli\core\services\departement\ServicesServiceInterface;

class ServicesService implements ServicesServiceInterface{

    public function addDepartement(array $departement){
        $dep = new Service();
        $dep->nom = $departement['name'];
        $dep->etage = $departement['etage'];
        $dep->description = $departement['desc'];
        $dep->save();
    }
}