<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche une catégorie
class GetHomePageAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $view = Twig::fromRequest($request);
        if (isset($_SESSION["user"])){
            $log = true;
            $prenom = $_SESSION["user"]->prenom;
            $nom = $_SESSION["user"]->nom;
        } else {
            $log = false;
            $prenom = "";
            $nom = "";
        }
        return $view->render($response, 'homePage.twig', ["log" => $log, "prenom" => $prenom, "nom"=>$nom]);
    }
}