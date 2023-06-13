<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

// permet l'affichage d'une box
class DisplayBoxAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère l'id de la box courante en session
        $boxId = $_SESSION['currentBox'] ?? null;

        // s'il n'y a pas de box courante, lance une erreur
        if ($boxId === null) {
            throw new HttpBadRequestException($request,"vous n'avez pas créé de Box, créez en une avant d'y accéder !");
        }

        // récupère la box
        $box = BoxService::getBoxById($boxId);
        // récupère les prestations
        $prestations = $box->prestation()->withPivot('quantite')->get();

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'afficherBox.twig', ['box' => $box, 'prestations' => $prestations]);
    }
}