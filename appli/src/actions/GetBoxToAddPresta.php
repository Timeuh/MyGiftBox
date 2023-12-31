<?php

namespace gift\app\actions;

use gift\app\models\Box;
use PHPUnit\Logging\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// permet l'ajout d'une prestation à une box
class GetBoxToAddPresta extends AbstractAction {

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $params = $request->getParsedBody();

            if (!isset($_SESSION["user"])){
                throw new Exception("Vous n'êtes pas connecté");
            }

            $box = Box::where('author_id', '=', $_SESSION['user']->email)->where("statut",1)->get();

            // charge la vue depuis la template Twig et la retourne
            $view = Twig::fromRequest($request);
            return $view->render($response, 'afficherListBoxAddPresta.twig', ['box' => $box, 'presta'=>$params['presta'], 'quantite'=>$params['quantite']]);
        } catch (Exception $e) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'exception.twig', ["error" => $e->getMessage()]);
        }
    }
}