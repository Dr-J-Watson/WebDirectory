<?php

namespace WebDir\core\api\core\services\service;

interface ServiceServiceInterface
{
    public function getServices(): array;
    public function getServicesByEntreeId(string $id): array;
    public function getLinksToEntreesByServiceId(string $id): array;
}