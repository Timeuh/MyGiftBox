<?php

namespace gift\app\services\box;

use DateTime;
use Exception;
use gift\app\models\Box;
use gift\app\models\Prestation;
use gift\app\models\Status;
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
        self::addMontant($prestaId,$boxId);
        return $box->save();
    }

    // récupère une box avec son id
    public static function getBoxById(string $boxId) : Box {
        return Box::find($boxId);
    }


    public static function delPrestation(string $prestaId, string $boxId){
        // récupère la box courante
        $box = Box::find($boxId);
        // lui ajoute la prestation
        $box->prestation()->detach($prestaId);
        self::delMontant($prestaId,$boxId);
    }

    public static function addQuantite(string $prestaId, string $boxId){
        // récupère la box courante
        $box = Box::find($boxId);
        // lui ajoute la prestation
        $presta = $box->prestation()->find($prestaId);
        $qty = $presta->pivot->quantite;
        $box->prestation()->updateExistingPivot($presta, ['quantite' => $qty+1]);
        self::addMontant($prestaId,$boxId);
    }

    public static function delQuantite(string $prestaId, string $boxId){
        // récupère la box courante
        $box = Box::find($boxId);
        // lui ajoute la prestation
        $presta = $box->prestation()->find($prestaId);
        $qty = $presta->pivot->quantite;
        $box->prestation()->updateExistingPivot($presta, ['quantite' => $qty-1]);
        self::delMontant($prestaId,$boxId);
    }

    private static function addMontant(string $prestaId, string $boxId){
        $box = Box::find($boxId);
        $presta = Prestation::find($prestaId);

        $box->montant += $presta->tarif;
        $box->save();
    }

    private static function delMontant(string $prestaId, string $boxId){
        $box = Box::find($boxId);
        $presta = Prestation::find($prestaId);

        $box->montant -= $presta->tarif;
        $box->save();
    }

}