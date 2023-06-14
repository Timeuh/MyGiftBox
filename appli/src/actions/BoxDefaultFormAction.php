<?php

namespace gift\app\actions;

use gift\app\models\Box;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

// affiche le formulaire de création de box
class BoxDefaultFormAction extends AbstractAction {
    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // génère un token csrf
        $csrf = CsrfService::generate();
        // si le token est mal généré
        if ($csrf['status'] === 500) {
            // lance une erreur
            throw new HttpBadRequestException($request, $csrf['message']);
        }

        $params = $request->getParsedBody();

        $box = Box::where("id", $params["id"])->first();


        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'boxFormDefault.twig', ['csrf' => $csrf['token'], "box"=>$box]);
    }
}