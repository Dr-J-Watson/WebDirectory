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

    //Récupère les liens vers les entreés d'un service /api/services/{id}/entrees pour une entrée
    public function getLinksToEntreesByServiceId(string $id): array
    {
        foreach ($this->getServicesByEntreeId($id) as $service) {
            $links[] = [
                'colections' => [
                    'href' => '/api/services/' . $service['id'] . '/entrees'
                ]
            ]; 
        }
        return $links ?? (['colections' => []]);
    }


} 