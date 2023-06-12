<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

// classe abstraite pour toutes les actions
abstract class AbstractAction {

    // méthode invoke magique pour exécuter l'action
    public abstract function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface;
}