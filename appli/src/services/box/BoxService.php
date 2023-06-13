<?php

namespace gift\app\services\box;

use DateTime;
use Exception;
use gift\app\models\Box;
use gift\app\models\Status;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

// gère les actions sur les box
class BoxService {

    // crée une box vide
    public static function createEmptyBox(array $attributes) : bool {
        // récupère les champs entrés par l'utilisateur
        $libelle = $attributes['libelle'];
        $description = $attributes['description'];
        $messageCadeau = $attributes['message_cadeau'];

        // les filtre, puis, s'ils ne correspondent pas, lance une erreur
        if ($libelle !== filter_var($libelle, FILTER_UNSAFE_RAW) || $description !== filter_var($description, FILTER_UNSAFE_RAW)
            || $messageCadeau !== filter_var($messageCadeau, FILTER_UNSAFE_RAW)){
            throw new Exception('Les champs entrés ne sont pas valides !');
        }

        // crée une box
        $box = new Box();

        // si la box est un cadeau, initialise les champs correspondants
        if (isset($attributes['cadeau']) &&  $attributes['cadeau'] === 'on') {
            $box->kdo = true;
            $box->message_kdo = $attributes['message_cadeau'];
        } else {
            $box->kdo = false;
        }

        // remplit les autres champs
        $box->libelle = $libelle;
        $box->description = $description;
        $box->montant = 0;
        $box->id = Uuid::uuid4()->toString();
        $box->token = base64_encode(random_bytes(32));
        $box->statut = Status::CREATED;

        // sauvegarde l'id de la box en session
        $_SESSION['currentBox'] = $box->id;

        // crée la box
        return $box->save();
    }

    // ajoute une prestation à une box
    public static function addPrestation(string $prestaId, string $boxId) : bool {
        // récupère la box courante
        $box = Box::find($boxId);
        // lui ajoute la prestation
        $box->prestation()->attach($prestaId, ['quantite' => 1, 'date' => new DateTime('now')]);
        // sauvegarde la box
        return $box->save();
    }

    // récupère une box avec son id
    public static function getBoxById(string $boxId) : Box {
        return Box::find($boxId);
    }

    // vérifie si la box peut être validée
    public static function checkCanValidate(Collection $prestations) : bool {
        // initialise des variables conteurs
        $catNumber = 0;
        $currentCat = 'noCat';

        // parcours les prestations de la box
        foreach($prestations as $presta){
            if ($currentCat !== $presta->categorie->libelle){
                $currentCat = $presta->categorie->libelle;
                $catNumber ++;
            }
        }

        // vérifie s'il y a au moins 2 catégories différentes et au moins 2 prestations
        return ($catNumber >= 2 && sizeof($prestations) >= 2);
    }

    // passe une box à l'état validé
    public static function validateBox(string $boxId) : bool {
        // retrouve la box en bd
        $box = Box::find($boxId);

        // si elle n'existe pas, retourne false
        if ($box === null){
            return false;
        }

        // change son statut
        $box->statut = Status::VALIDATED;

        // sauvegarde la modification
        return $box->save();
    }
}