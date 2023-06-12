<?php

use gift\app\services\utils\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// crée l'app et le moteur de templates
$app = AppFactory::create();
// crée le moteur de templates twig
$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);

// ajoute le routing et l'erreur middleware
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->setBasePath('');

// ajoute twig à l'app
$app->add(TwigMiddleware::create($app, $twig));

// initialise Eloquent avec le fichier de config
Eloquent::init(__DIR__ . '/../conf/gift.db.conf.ini');

session_start();

return $app;