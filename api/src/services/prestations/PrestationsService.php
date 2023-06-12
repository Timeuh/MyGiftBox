<?php

namespace gift\app\services\prestations;

use gift\app\models\Categorie;
use gift\app\models\Prestation;

// gère l'interaction avec la base de données
class PrestationsService {

    // retourne la liste des prestations
    public static function getPrestations(): array {
        $prestations = Prestation::all();
        $res = [];
        foreach($prestations as $prestation) {
            $res[] = $prestation;
        }
        return $res;
    }


    // retourne la liste des catégories
    public static function getCategories(): array {
        $categories = Categorie::all();
        $res = [];
        foreach($categories as $categorie) {
            $res[] = $categorie;
        }
        return $res;
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

    public static function getCategorieById(int $id): array {
        $cat = Categorie::find($id);
        return [$cat];
    }


}