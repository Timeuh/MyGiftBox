<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;
use gift\app\models\Box;

// permet l'affichage d'une liste de box
class DisplayListBoxAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        if (!isset($_SESSION["user"])){
                throw new HttpBadRequestException($request,"Vous n'êtes pas connecté");
        }

        $box = Box::where('author_id', '=', $_SESSION['user']->email)->get();

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'afficherListBox.twig', ['box' => $box]);
    }
}