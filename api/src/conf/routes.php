<?php

use gift\app\actions\GetCategories;
use gift\app\actions\GetPrestations;
use gift\app\actions\GetPrestationsByCategorie;

return function (Slim\App $app): void {

    $app->get('/api/prestations', GetPrestations::class)->setName('prestations');

    $app->get('/api/categories', GetCategories::class)->setName('categories');

    $app->get('/api/categories/{id}/prestations', GetPrestationsByCategorie::class)->setName('prestationsId');

    $app->get('/api/coffrets/{id}', GetCategories::class)->setName('coffretId');


};