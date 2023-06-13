<?php

use gift\app\actions\AddPrestaToBoxAction;
use gift\app\actions\BoxFormAction;
use gift\app\actions\CategorieFormAction;
use gift\app\actions\CreateBoxAction;
use gift\app\actions\CreateCategorieAction;
use gift\app\actions\DisplayBoxAction;
use gift\app\actions\DisplayCatPrestationsAction;
use gift\app\actions\GetCategorieAction;
use gift\app\actions\GetCategoriesAction;
use gift\app\actions\GetPrestationAction;

return function (Slim\App $app): void {

    //Affiche le get de la home page
    $app->get('[/]', \gift\app\actions\GetHomePageAction::class)->setName('homePage');

    //affiche le post de la home page
    $app->post('[/]', \gift\app\actions\GetHomePageAction::class)->setName('homePage');

    //Affiche log form
    $app->get('/login[/]', \gift\app\actions\LoginFormAction::class)->setName('login');

    //Affiche de log action
    $app->post('/login[/]', \gift\app\actions\LoginProcessAction::class)->setName('login');

    //Logout
    $app->get('/logout[/]', \gift\app\actions\LogoutProcessAction::class)->setName('logout');

    //Affiche reg form
    $app->get('/register[/]', \gift\app\actions\RegisterFormAction::class)->setName('register');

    //Affiche de reg action
    $app->post('/register[/]', \gift\app\actions\RegisterProcessAction::class)->setName('register');

    // affiche une liste cliquable des catégories
    $app->get('/categories[/]', GetCategoriesAction::class)->setName('categories');

    // affiche une catégorie
    $app->get('/categorie/{id}[/]', GetCategorieAction::class)->setName('catById');

    // affiche une prestation
    $app->get('/prestation', GetPrestationAction::class)->setName('presta');

    // affiche le formulaire de création de box
    $app->get('/boxes/new[/]', BoxFormAction::class)->setName('newBox');

    // crée une box
    $app->post('/boxes/new[/]', CreateBoxAction::class)->setName('createBox');

    // Lien d'accès à une box
    $app->get('/box/view/public/{id}[/]', \gift\app\actions\GetBoxFinieAction::class)->setName('boxFinieView');

    // afficher les prestations d'une catégorie
    $app->get('/categorie/{id}/prestations[/]', DisplayCatPrestationsAction::class)->setName('catPresta');

    // affiche le formulaire de création de catégorie
    $app->get('/new/categorie[/]', CategorieFormAction::class)->setName('newCat');

    // crée une catégorie
    $app->post('/new/categorie[/]', CreateCategorieAction::class)->setName('createCat');

    // ajoute une prestation à une box
    $app->post('/box/attach/prestation[/]', AddPrestaToBoxAction::class)->setName('prestaBox');

    // affiche la box courante
    $app->get('/box/view/current[/]', DisplayBoxAction::class)->setName('displayCurrentBox');
};