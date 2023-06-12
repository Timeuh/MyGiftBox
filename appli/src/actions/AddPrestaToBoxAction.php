<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// permet l'ajout d'une prestation à une box
class AddPrestaToBoxAction extends AbstractAction {

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère les paramètres de la requête
        $params = $request->getParsedBody();

        // ajoute la prestation à la box
        $success = BoxService::addPrestation($params['presta'], $params['box']);

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'boxToPresta.twig', ['prestaAdded' => $success]);
    }
}