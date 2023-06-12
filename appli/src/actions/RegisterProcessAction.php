<?php

namespace gift\app\actions;

use gift\app\services\authentification\Authentification;
use gift\app\services\prestations\PrestationsService;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

class RegisterProcessAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $params = $request->getParsedBody();

        $user = Authentification::inscription($params['email'], $params['password'], $params['prenom'], $params['nom']);
        echo $user->prenom." a été créé";

        $view = Twig::fromRequest($request);
        return $view->render($response, 'homePage.twig');
    }
}