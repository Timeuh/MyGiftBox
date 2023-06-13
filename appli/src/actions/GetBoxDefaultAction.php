<?php

namespace gift\app\actions;

use gift\app\models\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

class GetBoxDefaultAction extends AbstractAction{
    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface{

        $listBox = Box::where("statut", 6)->get();

        $view = Twig::fromRequest($request);
        return $view->render($response, 'afficherBoxDefault.twig', ["boxes" => $listBox]);
    }
}