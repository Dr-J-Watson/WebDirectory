<?php

namespace WebDir\core\appli\core\services\departement;

use WebDir\core\appli\core\domain\entities\Departement;
use WebDir\core\appli\core\services\departement\DepartementServiceInterface;

class DepartementService implements DepartementServiceInterface{

    public function addDepartement(array $departement){
        $dep = new Departement();
        $dep->nom = $departement['name'];
        $dep->etage = $departement['etage'];
        $dep->description = $departement['desc'];
        $dep->save();
    }
}