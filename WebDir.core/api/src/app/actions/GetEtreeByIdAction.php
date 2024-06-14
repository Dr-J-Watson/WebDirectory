<?php

namespace WebDire\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDire\core\api\core\services\EntreeService;
use WebDire\core\api\core\services\EntreeServiceInterface;

class GetEtreeByIdAction extends AbstractAction
{
    private EntreeServiceInterface $entreeService;

    public function __construct(EntreeServiceInterface $entreeService)
    {
        $this->entreeService = $entreeService;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $entree = $this->entreeService->getEntreeById((int)$args['id']);

        return $this->respondWithData($entree, $response);
    }
}

