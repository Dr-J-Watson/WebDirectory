<?php

namespace WebDir\core\appli\core\services\personne;

use WebDir\core\appli\core\domain\entities\Personne;

class PersonneService implements PersonneServiceInterface{

    public function addPersonne(array $personne){
        $newPersonne = new Personne();
        $newPersonne->lastName = $personne['lastName'];
        $newPersonne->firstName  = $personne['firstName'];
        $newPersonne->numBureau = $personne['numBureau'];
        $newPersonne->telFixe = $personne['telFixe'];
        $newPersonne->telMobile = $personne['telMobile'];
        $newPersonne->email = $personne['email'];
        $newPersonne->image = $personne['image'];
        $newPersonne->save();
    }
}