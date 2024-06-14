<?php

namespace WebDir\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\api\core\services\services\ServiceService;
use WebDir\core\api\core\services\services\ServiceServiceInterface;

class GetServicesAction extends AbstractAction
{
    private ServiceServiceInterface $serviceService;

    public function __construct(ServiceServiceInterface $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $services = $this->serviceService->getServices();
        $rs->getBody()->write(json_encode($services));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}