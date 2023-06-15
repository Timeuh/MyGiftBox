<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

// crée une nouvelle box
class CreateBoxAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère les paramètres du formulaire
        $params = $request->getParsedBody();

        // si l'utilisateur a choisi une template de box
        if ($params['template'] !== 'default'){
            // charge le lien vers la création de box via template
            $routeContext = RouteContext::fromRequest($request);
            $routeParser = $routeContext->getRouteParser();
            $url = $routeParser->urlFor('createBoxDefault');

            // retourne la redirection
            return $response->withStatus(307)->withHeader('Location', $url);
        }

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