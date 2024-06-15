<?php

namespace WebDir\core\api\core\services\entree;

use WebDir\core\api\core\domain\entities\Entree;
use WebDir\core\api\core\domain\entities\Service;

class EntreeService implements EntreeServiceInterface
{
    // Récupère toutes les entrées sous forme de tableau
    public function getEntrees(): array
    {
        $entrees = Entree::all();
        return $entrees->toArray();
    }

    // Récupère une entrée par son id
    public function getEntreeById(string $id): array
    {
        try {
            $entree = Entree::findOrFail($id);
            return $entree->toArray();
        } catch (\Exception $e) {
            throw new EntreeServiceNotFoundException("Entree not found");
        }
    }

    // Retourne les entrées d'un service grace à son id sous forme de tableau
    public function getEntreesByServiceId(string $id): array
    {
        $service = Service::findOrFail($id);
        return $service->entree->toArray();
    }
}