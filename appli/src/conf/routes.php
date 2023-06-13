<?php

use gift\app\actions\AddPrestaToBoxAction;
use gift\app\actions\BoxFormAction;
use gift\app\actions\CategorieFormAction;
use gift\app\actions\CreateBoxAction;
use gift\app\actions\CreateCategorieAction;
use gift\app\actions\DelPrestaBox;
use gift\app\actions\DisplayBoxAction;
use gift\app\actions\DisplayCatPrestationsAction;
use gift\app\actions\DisplayListBoxAction;
use gift\app\actions\GetBoxDefaultAction;
use gift\app\actions\GetBoxFinieAction;
use gift\app\actions\GetBoxToAddPresta;
use gift\app\actions\GetCategorieAction;
use gift\app\actions\GetCategoriesAction;
use gift\app\actions\GetHomePageAction;
use gift\app\actions\GetPrestationAction;
use gift\app\actions\LoginFormAction;
use gift\app\actions\LoginProcessAction;
use gift\app\actions\LogoutProcessAction;
use gift\app\actions\RegisterFormAction;
use gift\app\actions\RegisterProcessAction;

return function (Slim\App $app): void {

    //Affiche le get de la home page
    $app->get('[/]', GetHomePageAction::class)->setName('homePage');

    //affiche le post de la home page
    $app->post('[/]', GetHomePageAction::class)->setName('homePage');

    //Affiche mkrg form
    $app->get('/login[/]', LoginFormAction::class)->setName('login');

    //Affiche de log action
    $app->post('/login[/]', LoginProcessAction::class)->setName('login');

    //Logout
    $app->get('/logout[/]', LogoutProcessAction::class)->setName('logout');

    //Affiche reg form
    $app->get('/register[/]', RegisterFormAction::class)->setName('register');

    //Affiche de reg action
    $app->post('/register[/]', RegisterProcessAction::class)->setName('register');

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

    //Afficher box par défaut
    $app->get("/box/default[/]", GetBoxDefaultAction::class)->setName('boxDefault');

    // Lien d'accès à une box
    $app->get('/box/view/public/{token}[/]', DisplayBoxAction::class)->setName('boxView');

    // afficher les prestations d'une catégorie
    $app->get('/categorie/{id}/prestations[/]', DisplayCatPrestationsAction::class)->setName('catPresta');

    // affiche le formulaire de création de catégorie
    $app->get('/new/categorie[/]', CategorieFormAction::class)->setName('newCat');

    // crée une catégorie
    $app->post('/new/categorie[/]', CreateCategorieAction::class)->setName('createCat');

    // Demande dans quelle box on ajoute
    $app->post('/box/attach/[/]', GetBoxToAddPresta::class)->setName('takeBox');

    // ajoute une prestation à une box
    $app->post('/box/attach/prestation[/]', AddPrestaToBoxAction::class)->setName('AddPrestaToBox');

    // affiche la box courante
    $app->get('/box/view/public[/]', DisplayListBoxAction::class)->setName('displayBox');

    // supprime une prestation de la box
    $app->post('/box/del/prestation[/]', DelPrestaBox::class)->setName('delPrestaBox');
};