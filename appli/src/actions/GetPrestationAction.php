<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use gift\app\models\Box;

// affiche une prestation
class GetPrestationAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère les paramètres de la requête
        $params = $request->getQueryParams();

        // si l'id n'est pas spécifié
        if (!isset($params['id'])) {
            // lance une erreur 400
            throw new HttpBadRequestException($request, 'Il faut spécifier un id');
        }

        $id = $params['id'];

        // récupère la prestation
        $prestation = PrestationsService::getPrestationById($id);

        // si la prestation existe, l'affiche
        if ($prestation[0] === null){
            // sinon lance une erreur 404
            throw new HttpNotFoundException($request, 'La prestation n\'existe pas');
        }

        $currentBoxId = false;
        // on vérifie que l'utilisateur a au - une box
        if (isset($_SESSION['user'])) {
            $box = Box::where("author_id", $_SESSION['user']->email)->first();
            if ($box!=null){
                $currentBoxId = true;
            }
        }

        // done un statut par défaut
        $boxStatus = 4;

        // récupère le statut de la box
        if ($currentBoxId !== null) {
            $box = BoxService::getBoxById($currentBoxId);
            $boxStatus = $box->statut;
        }

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'prestation.twig', ['presta' => $prestation[0], 'box_id'=>$currentBoxId, 'box_status'=> $boxStatus]);
    }
}