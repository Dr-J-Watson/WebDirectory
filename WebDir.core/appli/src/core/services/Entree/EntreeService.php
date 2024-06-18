<?php

namespace WebDir\core\appli\core\services\Entree;

use WebDir\core\appli\core\domain\entities\Entree;

class EntreeService implements EntreeServiceInterface{

    public function addEntree(array $personne, array $dep): void{
        $newPersonne = new Entree();
        $newPersonne->lastName = $personne['lastName'];
        $newPersonne->firstName  = $personne['firstName'];
        $newPersonne->numBureau = $personne['numBureau'];
        $newPersonne->telFixe = $personne['telFixe'];
        $newPersonne->telMobile = $personne['telMobile'];
        $newPersonne->email = $personne['email'];
        $newPersonne->image = $personne['image'];
        $newPersonne->save();


        foreach ($dep as $departement) {
            $newPersonne->department()->attach($newPersonne['uuid'], ['department_id' => $departement['id']]);
        }

    }

    public function getEntree(): array{
        return Entree::all()->toArray();
    }
}