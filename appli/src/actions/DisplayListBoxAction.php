<?php

namespace gift\app\actions;

use gift\app\models\Box;
use PHPUnit\Logging\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// permet l'affichage d'une liste de box
class DisplayListBoxAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            if (!isset($_SESSION["user"])){
                throw new Exception("Erreur : Vous n'êtes pas connecté");
            }

            $box = Box::where('author_id', '=', $_SESSION['user']->email)->get();

            // charge la vue depuis la template Twig et la retourne
            $view = Twig::fromRequest($request);
            return $view->render($response, 'afficherListBox.twig', ['box' => $box]);
        } catch (Exception $e) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'exception.twig', ["error" => $e->getMessage()]);
        }
    }
}