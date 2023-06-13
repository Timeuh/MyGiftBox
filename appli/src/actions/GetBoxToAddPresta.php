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
class GetBoxToAddPresta extends AbstractAction {

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $params = $request->getParsedBody();

        if (!isset($_SESSION["user"])){
            throw new HttpBadRequestException($request,"Vous n'etes pas connecter");
        }

        $box = Box::where('author_id', '=', $_SESSION['user']->email)->where("statut",1)->get();

        // charge la vue depuis la template Twig et la retourne
        $view = Twig::fromRequest($request);
        return $view->render($response, 'afficherListBoxAddPresta.twig', ['box' => $box, 'presta'=>$params['presta']]);
    }
}