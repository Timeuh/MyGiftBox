<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

// affiche une catégorie
class LogoutProcessAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $view = Twig::fromRequest($request);
        unset($_SESSION['user']);
        $_SESSION['currentBox'] = null;
        $log = false;
        $prenom = "";
        $nom = "";
        return $view->render($response, 'homePage.twig', ["log" => $log, "prenom" => $prenom, "nom"=>$nom]);
    }
}