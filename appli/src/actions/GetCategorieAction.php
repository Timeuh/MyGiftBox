<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use PHPUnit\Logging\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche une catégorie
class GetCategorieAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            // si la catégorie n'est pas renseignée dans l'url
            if (!isset($args['id'])){
                // lance une erreur 400
                throw new Exception($request, 'Identifiant de catégorie manquant');
            }

            // récupère la catégorie
            $categorie = PrestationsService::getCategorieById(intval($args['id']))[0];

            // charge la vue depuis la template Twig et la retourne
            $view = Twig::fromRequest($request);
            return $view->render($response, 'categorie.twig', ['cat' => $categorie]);
        } catch (Exception $e) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'exception.twig', ["error" => $e->getMessage()]);
        }
    }
}