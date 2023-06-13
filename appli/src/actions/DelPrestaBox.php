<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use gift\app\models\Box;

// permet l'ajout d'une prestation à une box
class DelPrestaBox extends AbstractAction {

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère les paramètres de la requête
        $params = $request->getParsedBody();

        // supprime la prestation à la box
        $box = Box::find($params['box']);
        // récupère les prestations
        $prestations = $box->prestation()->find($params['presta']);
        $qty = $prestations->pivot->quantite;

        if ($qty==1) {
            BoxService::delPrestation($params['presta'], $params['box']);
        }else{
            BoxService::delQuantite($params['presta'], $params['box']);
        }

        // charge la vue depuis la template Twig et la retourne
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();
        $url = $routeParser->urlFor('boxView',['token'=>$box->token]);

        // retourne la redirection
        return $response->withStatus(302)->withHeader('Location', $url);
    }
}