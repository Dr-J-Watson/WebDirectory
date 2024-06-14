<?php

namespace WebDir\core\appli\core\services\personne;

use WebDir\core\appli\core\domain\entities\Entree;

class EntreeService implements EntreeServiceInterface{

    public function addEntree(array $personne): void{
        $newPersonne = new Entree();
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