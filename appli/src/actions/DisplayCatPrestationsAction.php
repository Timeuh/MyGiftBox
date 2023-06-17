<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use PHPUnit\Logging\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class DisplayCatPrestationsAction extends AbstractAction{
    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface{
        try {
            // si la catégorie n'est pas renseignée dans l'url
            if (!isset($args['id'])){
                // lance une erreur 400
                throw new Exception('Erreur : Identifiant de catégorie manquant');
            }

            // récupère les prestations et la catégorie
            $prestations = PrestationsService::getPrestationsByCategorie($args['id'], $args['order']);
            $categorie = PrestationsService::getCategorieById($args['id'])[0];

            // charge la vue depuis la template Twig et la retourne
            $view = Twig::fromRequest($request);
            return $view->render($response, 'categoriePrestations.twig', ['cat' => $categorie, 'prestations' => $prestations]);
        } catch (Exception $e) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'exception.twig', ["error" => $e->getMessage()]);
        }
    }
}