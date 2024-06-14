<?php 

namespace WebDir\core\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDir\core\api\core\services\EntreeService;
use WebDir\core\api\core\services\EntreeServiceInterface;



class GetEntreesAction extends AbstractAction
{
    private EntreeServiceInterface $entreeService;

    public function __construct(EntreeServiceInterface $entreeService)
    {
        $this->entreeService = $entreeService;
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $entrees = $this->entreeService->getEntrees();
        $rs->getBody()->write(json_encode($entrees));
        return $rs->withHeader('Content-Type', 'application/json');
    }
}