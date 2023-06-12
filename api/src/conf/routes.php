<?php

use gift\app\actions\GetCategories;
use gift\app\actions\GetPrestations;
use gift\app\actions\GetPrestationsByCategorie;
use gift\app\actions\GetCoffretById;

return function (Slim\App $app): void {

    $app->get('/api/prestations', GetPrestations::class);

    $app->get('/api/categories', GetCategories::class);

    $app->get('/api/categories/{id}/prestations', GetPrestationsByCategorie::class);

    $app->get('/api/coffrets/{id}', GetCoffretById::class);


};