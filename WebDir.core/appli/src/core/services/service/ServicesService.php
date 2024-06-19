<?php

namespace WebDir\core\appli\core\services\service;

use WebDir\core\appli\core\domain\entities\Service;
use WebDir\core\appli\core\services\service\ServicesServiceInterface;

class ServicesService implements ServicesServiceInterface{

    public function addDepartement(array $departement){
        $dep = new Service();
        $dep->nom = $departement['name'];
        $dep->etage = $departement['etage'];
        $dep->description = $departement['desc'];
        $dep->save();
    }

    public function getDepartements(array $departements){
        $a = Service::select('id')->whereIn('nom', $departements)->get();
        return $a;
    }

    public function getServices(){
        return Service::select('nom')->get();
    }
}