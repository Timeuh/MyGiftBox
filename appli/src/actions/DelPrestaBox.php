<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;
use gift\app\models\Box;

// permet l'ajout d'une prestation à une box
class DelPrestaBox extends AbstractAction {

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère les paramètres de la requête
        $params = $request->getParsedBody();

        // supprime la prestation à la box
        $box = BoxService::getBoxById($params['box']);
        // récupère les prestations
        $prestation = $box->prestation()->find($params['presta']);
        $qty = $prestation->pivot->quantite;

        if ($qty==1) {
            BoxService::delPrestation($params['presta'], $params['box']);
        }else{
            BoxService::delQuantite($params['presta'], $params['box']);
        }

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'SupprimerPresta.twig', ['prestaAdded' => true]);
    }
}