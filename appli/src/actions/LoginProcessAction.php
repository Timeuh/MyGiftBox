<?php

namespace gift\app\actions;

use gift\app\services\authentification\Authentification;
use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

class LoginProcessAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $params = $request->getParsedBody();

        $user = Authentification::connexion($params['email'], $params['password']);
        echo "le user c'est ".$user->prenom;

        $view = Twig::fromRequest($request);
        return $view->render($response, 'homePage.twig');
    }
}