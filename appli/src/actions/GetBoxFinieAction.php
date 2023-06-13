<?php

namespace gift\app\actions;

use gift\app\models\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

class GetBoxFinieAction extends AbstractAction{
    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface{

        // si l'id n'est pas spécifié
        if (!isset($args['id'])) {
            // lance une erreur 400
            throw new HttpBadRequestException($request, 'Il faut spécifier un id');
        }
        $id = $args['id'];

        // récupère les prestations et la catégorie
        $row = Box::where("id", $id)->where("statut", 3);
        if (!$row->first()) throw new HttpBadRequestException($request, 'Cet id n\'existe pas ou n\'est pas prêt');
        $box = $row->first();
        $prestations = $box->prestation()->get();

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'afficherBoxFinie.twig', ["box" => $box, "prestations"=>$prestations]);
    }
}