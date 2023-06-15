<?php

namespace gift\app\actions;

use Exception;
use gift\app\services\authentification\Authentification;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class RegisterProcessAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            // récupère les champs du formulaire
            $params = $request->getParsedBody();

            // inscrit l'utilisateur
            Authentification::inscription($params['email'], $params['password'], $params['prenom'], $params['nom']);

            // récupère l'utilisateur
            $user = $_SESSION['user'] ?? null;

            // s'il n'existe pas, lance une exception
            if (!$user){
                throw new Exception('Vous n\'êtes pas connecté');
            }

            $view = Twig::fromRequest($request);
            return $view->render($response, 'homePage.twig', ["log" => true, "prenom" => $user->prenom, "nom"=>$user->nom]);
        } catch (Exception $e) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'exception.twig', ["error" => $e->getMessage()]);
        }
    }
}