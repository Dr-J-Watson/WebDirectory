<?php

namespace WebDir\core\api\core\services\service;

use WebDir\core\api\core\domain\entities\Entree;
use WebDir\core\api\core\domain\entities\Service;

class ServiceService implements ServiceServiceInterface
{
    //Récupère tous les services sous forme de tableau
    public function getServices(): array
    {
        $services = Service::all();
        if ($services->isEmpty()) {
            return [];
        }
        return $services->toArray();
    }

    //Récupère les services d'une entrée grace à son id
    public function getServicesByEntreeId(string $id): array
    {
        $entree = Entree::findOrFail($id);
        return $entree->services->toArray();
    }

    //Récupère le lien vers un service grace à son id "/api/services/{id}/entrees"
    public function getLinkToServiceById(string $id): string
    {
        return "/api/services/" . $id . "/entrees";
    }

    
    public function getLinksToEntreesByServiceId(string $id): array
    {
        $services = $this->getServicesByEntreeId($id);
        $links = [];
        foreach ($services as $service) {
            $links[$service["nom"]] = $this->getLinkToServiceById($service['id']);
        }
        return $links;
    }
    

    //Retourne le nom des services d'une entrée grace à son id sous forme de tableau
    public function getNameServicesByEntreeId(string $id): array
    {
        $entree = Entree::findOrFail($id);
        $services = $entree->services->toArray();
        $names = [];
        foreach ($services as $service) {
            $names[] = $service['nom'];
        }
        return $names;
    }

    public function getNameServiceById(string $id): string
    {
        $service = Service::findOrFail($id);
        return $service->nom;
    }


} 