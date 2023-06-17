<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use gift\app\services\user\UserService;
use PHPUnit\Logging\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche une prestation
class GetPrestationAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            // récupère les paramètres de la requête
            $params = $request->getQueryParams();

            // si l'id n'est pas spécifié
            if (!isset($params['id'])) {
                // lance une erreur 400
                throw new Exception('Erreur : Il faut spécifier un id');
            }

            $id = $params['id'];

            // récupère la prestation
            $prestation = PrestationsService::getPrestationById($id);

            // si la prestation existe, l'affiche
            if ($prestation[0] === null) {
                // sinon lance une erreur 404
                throw new Exception('Erreur : La prestation n\'existe pas');
            }

            // récupère la catégorie de la prestation
            $cat = $prestation[0]->categorie->libelle;

            // vérifie si l'utilisateur courant a des box modifiables
            $hasEditableBoxes = UserService::checkUserHasEditableBox();

            // charge la vue depuis la template Twig et la retourne
            $view = Twig::fromRequest($request);
            return $view->render($response, 'prestation.twig', ['presta' => $prestation[0], 'cat' => $cat, 'hasBox' => $hasEditableBoxes]);
        } catch (Exception $e) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'exception.twig', ["error" => $e->getMessage()]);
        }
    }
}