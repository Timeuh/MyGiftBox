<?php

namespace gift\app\actions;

use gift\app\models\Box;
use gift\app\services\box\BoxService;
use gift\app\services\utils\CsrfService;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

// crée une nouvelle box
class CreateBoxAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère les paramètres du formulaire
        $params = $request->getParsedBody();

        // récupère le token csrf
        $token = $params['csrf'] ?? null;

        // si le token est null lance une exception
        if ($token === null) {
            throw new HttpBadRequestException($request, 'Erreur : le token manque');
        }

        // vérifie le token
        CsrfService::check($token);

        // crée la box
        $created = BoxService::createEmptyBox($params);

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'box.twig', ['boxCreated' => $created]);
    }
}