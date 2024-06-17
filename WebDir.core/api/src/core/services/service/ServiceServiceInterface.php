<?php

namespace WebDir\core\api\core\services\service;

interface ServiceServiceInterface
{
    public function getServices(): array;
    public function getServicesByEntreeId(string $id): array;
    public function getLinksToEntreesByServiceId(string $id): array;
    public function getNameServicesByEntreeId(string $id): array;
    public function getNameServiceById(string $id): string;
    public function getLinkToServiceById(string $id): string;
}