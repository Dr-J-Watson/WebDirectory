<?php

namespace WebDir\core\api\core\services\entree;

use WebDir\core\api\core\domain\entities\Entree;
use WebDir\core\api\core\domain\entities\Service;

class EntreeService implements EntreeServiceInterface
{
    // Récupère toutes les entrées sous forme de tableau
    public function getEntrees(?string $sort = null): array
    {
        $query = Entree::query();
    
        if ($sort) {
            if ($sort === 'nom-asc') {
                $query->orderBy('lastName', 'asc');
            } elseif ($sort === 'nom-desc') {
                $query->orderBy('lastName', 'desc');
            }
        }
    
        $entrees = $query->get();
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
    public function getEntreesByServiceId(string $id, ?string $sort = null): array
    {
        $service = Service::findOrFail($id);
        $query = $service->entree();

        if ($sort) {
            if ($sort === 'nom-asc') {
                $query->orderBy('lastName', 'asc');
            } elseif ($sort === 'nom-desc') {
                $query->orderBy('lastName', 'desc');
            }
        }
    
        $entrees = $query->get();
        return $entrees->toArray();
    }
    

    public function searchEntrees(?string $search, ?string $sort = null): array
    {
        if ($search != null)
        {
            $query = Entree::where('lastName', 'like', '%' . $search . '%')
            ->orWhere('firstName', 'like', '%' . $search . '%');
        }else{
            return $this->getEntrees($sort);
        }
    
        if ($sort) {
            if ($sort === 'nom-asc') {
                $query->orderBy('lastName', 'asc');
            } elseif ($sort === 'nom-desc') {
                $query->orderBy('lastName', 'desc');
            }
        }
    
        $entrees = $query->get();
        return $entrees->toArray();
    }

    public function searchEntreesInService(string $serviceId, ?string $search, ?string $sort = null): array
    {

        $service = Service::findOrFail($serviceId);
        $query = $service->entree();

        if ($search != null)
        {
            $query->where(function($subQuery) use ($search) {
                $subQuery->where('lastName', 'like', '%' . $search . '%')
                         ->orWhere('firstName', 'like', '%' . $search . '%');
            });
        }
    
        if ($sort) {
            if ($sort === 'nom-asc') {
                $query->orderBy('lastName', 'asc');
            } elseif ($sort === 'nom-desc') {
                $query->orderBy('lastName', 'desc');
            }
        }
    
        return $query->get()->toArray();
    }
    
}