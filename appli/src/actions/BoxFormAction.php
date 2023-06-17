<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use gift\app\services\utils\CsrfService;
use PHPUnit\Logging\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche le formulaire de création de box
class BoxFormAction extends AbstractAction {
    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            // génère un token csrf
            $csrf = CsrfService::generate();

            // si le token est mal généré
            if ($csrf['status'] === 500) {
                // lance une erreur
                throw new Exception($csrf['message']);
            }

            // récupère les box templates
            $templatesBoxes = BoxService::getTemplateBoxes();

            // charge la vue depuis la template Twig et la retourne
            $view = Twig::fromRequest($request);
            return $view->render($response, 'boxForm.twig', ['csrf' => $csrf['token'],'templates'=>$templatesBoxes]);
        } catch (Exception $e) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'exception.twig', ["error" => $e->getMessage()]);
        }
    }
}