<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use PHPUnit\Logging\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// valide une box
class ValiderBoxAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            // récupère l'id de la box courante
            $boxToken = $args['token'] ?? null;

            // si la box courante n'existe pas, lance une exception
            if ($boxToken === null) {
                throw new Exception("Erreur dans la récupération de la box !");
            }

            // valide la box
            $success = BoxService::validateBox($boxToken);

            // charge la vue depuis la template Twig et la retourne
            $view = Twig::fromRequest($request);
            return $view->render($response, 'validateBox.twig', ['boxValidated' => $success]);
        } catch (Exception $e) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'exception.twig', ["error" => $e->getMessage()]);
        }
    }
}