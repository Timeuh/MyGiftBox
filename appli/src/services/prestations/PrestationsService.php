<?php

namespace gift\app\services\prestations;

use Exception;
use gift\app\models\Categorie;
use gift\app\models\Prestation;

// gère l'interaction avec la base de données
class PrestationsService {
    // retourne la liste des catégories
    public static function getCategories(): array {
        $categories = Categorie::all();
        $res = [];
        foreach($categories as $categorie) {
            $res[] = $categorie;
        }
        return $res;
    }

    // retourne une categorie par son id
    public static function getCategorieById(int $id): array {
        $cat = Categorie::find($id);
        return [$cat];
    }

    // retourne une prestation par son id
    public static function getPrestationById(string $id): array {
        $prestation = Prestation::find($id);
        return [$prestation];
    }

    // retourne la liste des prestations d'une catégorie
    public static function getPrestationsByCategorie(int $categ_id): array {
        $prestations = Categorie::find($categ_id)->prestation()->get();
        $res = [];
        foreach($prestations as $presta) {
            $res[] = $presta;
        }
        return $res;
    }

    // met à jour une prestation
    public static function updatePrestation(array $attributes): bool {
        $prestation = Prestation::find($attributes['id']);

        // si la prestation existe, on la met à jour
        if ($prestation){
            $prestation->update($attributes);
            return true;
        } else {
            return false;
        }
    }

    // change la catégorie d'une prestation
    public static function setPrestationCategorie(string $presta_id, int $cat_id): bool {
        $prestation = Prestation::find($presta_id);
        $categorie = Categorie::find($cat_id);

        // si la prestation et la catégorie existent, on met à jour la catégorie de la prestation
        if ($prestation && $categorie){
            $prestation->categorie()->cat_id = $cat_id;
            $prestation->save();
            return true;
        } else {
            return false;
        }
    }

    // crée une catégorie
    public static function createCategorie(array $attributes): int{
        // filtre les données
        $filteredLibelle = filter_var($attributes['libelle'], FILTER_UNSAFE_RAW);
        $filteredDescription = filter_var($attributes['description'], FILTER_UNSAFE_RAW);

        // compare les données filtrées avec celles entrées
        if ($filteredLibelle !== $attributes['libelle'] || $filteredDescription !== $attributes['description']){
            // si elles ne correspondent pas, lance une erreur
            throw new Exception('Vous avez entré des valeurs incorrectes');
        }

        // crée la catégorie et l'enregistre
        $cat = new Categorie();
        $cat->libelle = $attributes['libelle'];
        $cat->description = $attributes['description'];
        $cat->save();

        // retourne l'id de la catégorie créée
        return $cat->id;
    }

    // supprime une catégorie
    public static function deleteCategorie(int $id): bool {
        // récupère la catégorie
        $cat = Categorie::find($id);

        // si la catégorie existe, on la supprime
        if ($cat){
            $cat->delete();
            return true;
        } else {
            return false;
        }
    }
}