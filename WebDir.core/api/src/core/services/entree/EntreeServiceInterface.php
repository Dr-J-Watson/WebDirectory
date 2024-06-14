<?php

namespace WebDir\core\api\core\services\entree;

interface EntreeServiceInterface
{
    public function getEntrees(): array;
    public function getEntreeById(string $id): array;
}