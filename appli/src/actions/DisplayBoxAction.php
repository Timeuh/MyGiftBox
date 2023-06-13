<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;
use gift\app\models\Box;

// permet l'affichage d'une box
class DisplayBoxAction extends AbstractAction
{

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // récupère l'id de la box courante en session
        $boxId = $args['token'];

        // s'il n'y a pas de box courante, lance une erreur
        if ($boxId === null) {
            throw new HttpBadRequestException($request, "Il n'y as pas d'id dans l'url");
        }

        // récupère la box
        $box = Box::where("token",$boxId)->first();
        if (!isset($_SESSION["user"]->email) || $_SESSION["user"]->email != $box->author_id) {
            if ($box->statut < 3) {
                throw new HttpBadRequestException($request, "Vous ne pouvez pas encore acceder à cette box");
            }
        }

        // récupère les prestations
        $prestations = $box->prestation()->withPivot('quantite')->get();

        if ($box->statut >= 2){
            $canValidate = false;
        } else {
            // vérifie si la box peut être validée
            $canValidate = BoxService::checkCanValidate($prestations);
        }

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);

        if ($box->statut < 3) {
            return $view->render($response, 'afficherBox.twig', ['box' => $box, 'prestations' => $prestations]);
        } else {
            return $view->render($response, 'afficherBoxFinie.twig', ['box' => $box, 'prestations' => $prestations]);
        }
    }
}