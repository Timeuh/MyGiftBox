<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

// permet l'ajout d'une prestation à une box
class AddPrestaToBoxAction extends AbstractAction {

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère les paramètres de la requête
        $params = $request->getParsedBody();

        $box = BoxService::getBoxById($params['box']);
        // récupère les prestations
        $prestations = $box->prestation()->find($params['presta']);

        if ($prestations == null) {
            BoxService::addPrestation($params['presta'], $params['box']);
        }else{
            BoxService::addQuantite($params['presta'], $params['box']);
        }

        // charge la vue depuis la template Twig et la retourne
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();
        $url = $routeParser->urlFor('boxView',['token'=>$box->token]);

        // retourne la redirection
        return $response->withStatus(302)->withHeader('Location', $url);
    }
}