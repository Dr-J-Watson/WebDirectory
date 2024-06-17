<?php

namespace WebDir\core\api\core\services\entree;

interface EntreeServiceInterface
{
    public function getEntrees(?string $sort = null): array;
    public function getEntreeById(string $id): array;
    public function getEntreesByServiceId(string $id, ?string $sort = null): array;
    public function searchEntrees(string $search, ?string $sort = null): array;

}