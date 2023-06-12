<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;

// crée une catégorie
class CreateCategorieAction extends AbstractAction {

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

        // crée la catégorie
        PrestationsService::createCategorie($params);

        // récupère la route de redirection
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();
        $url = $routeParser->urlFor('categories');

        // retourne la redirection
        return $response->withStatus(302)->withHeader('Location', $url);
    }
}