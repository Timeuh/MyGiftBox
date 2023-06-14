<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

// permet de payer une box
class ConfirmerPaiementAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère l'id de la box courante
        $boxToken = $args['token'] ?? null;

        // si la box courante n'existe pas, lance une exception
        if ($boxToken === null) {
            throw new HttpBadRequestException($request, "Erreur dans la récupération de la box !");
        }

        // confirme le paiement de la box
        $success = BoxService::confirmerPaiement($boxToken);

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'afficherConfirmationPaiement.twig', ['success'=>$success]);
    }
}