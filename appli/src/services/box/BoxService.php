<?php

namespace gift\app\services\box;

use DateTime;
use Exception;
use gift\app\models\Box;
use gift\app\models\Prestation;
use gift\app\models\Status;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

// gère les actions sur les box
class BoxService
{

    // crée une box vide
    public static function createEmptyBox(array $attributes): bool
    {
        // récupère les champs entrés par l'utilisateur
        $libelle = $attributes['libelle'];
        $description = $attributes['description'];
        $messageCadeau = $attributes['message_cadeau'];

        // les filtre, puis, s'ils ne correspondent pas, lance une erreur
        if ($libelle !== filter_var($libelle, FILTER_UNSAFE_RAW) || $description !== filter_var($description, FILTER_UNSAFE_RAW)
            || $messageCadeau !== filter_var($messageCadeau, FILTER_UNSAFE_RAW)) {
            throw new Exception('Les champs entrés ne sont pas valides !');
        }

        // les filtre, puis, s'ils ne correspondent pas, lance une erreur
        if (!isset($_SESSION["user"]->email)) {
            throw new Exception('Il faut etre connecté pour créer une box');
        }

        // crée une box
        $box = new Box();

        // si la box est un cadeau, initialise les champs correspondants
        if (isset($attributes['cadeau']) && $attributes['cadeau'] === 'on') {
            $box->kdo = true;
            $box->message_kdo = $attributes['message_cadeau'];
        } else {
            $box->kdo = false;
        }

        // remplit les autres champs
        $box->libelle = $libelle;
        $box->author_id = $_SESSION["user"]->email;
        $box->description = $description;
        $box->montant = 0;
        $box->id = Uuid::uuid4()->toString();
        $box->token = self::generateToken();
        $box->statut = Status::CREATED;

        // sauvegarde l'id de la box en session
        $_SESSION['currentBox'] = $box->id;

        // crée la box
        return $box->save();
    }

    public static function createEmptyBoxReturnId(array $attributes) {
        // récupère les champs entrés par l'utilisateur
        $libelle = $attributes['libelle'];
        $description = $attributes['description'];
        $messageCadeau = $attributes['message_cadeau'];

        // les filtre, puis, s'ils ne correspondent pas, lance une erreur
        if ($libelle !== filter_var($libelle, FILTER_UNSAFE_RAW) || $description !== filter_var($description, FILTER_UNSAFE_RAW)
            || $messageCadeau !== filter_var($messageCadeau, FILTER_UNSAFE_RAW)){
            throw new Exception('Les champs entrés ne sont pas valides !');
        }

        // les filtre, puis, s'ils ne correspondent pas, lance une erreur
        if (!isset($_SESSION["user"]->email)){
            throw new Exception('Il faut etre connecté pour créer une box');
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
        $box->author_id = $_SESSION["user"]->email;
        $box->description = $description;
        $box->montant = 0;
        $idAlea = Uuid::uuid4()->toString();
        $box->id = $idAlea;
        $box->token = self::generateToken();
        $box->statut = Status::CREATED;

        // sauvegarde l'id de la box en session
        $_SESSION['currentBox'] = $box->id;

        // crée la box
        $box->save();
        return $idAlea;
    }

    // ajoute une prestation à une box
    public static function addPrestation(string $prestaId, string $boxId, int $quantite) : bool {
        // met la quantité à 1 si elle est négative
        if ($quantite <= 0) {
            $quantite = 1;
        }

        // récupère la box courante
        $box = Box::find($boxId);
        // lui ajoute la prestation
        $box->prestation()->attach($prestaId, ['quantite' => $quantite, 'date' => new DateTime('now')]);
        // sauvegarde la box
        self::addMontant($prestaId,$boxId, $quantite);

        return $box->save();
    }

    // récupère une box avec son id
    public static function getBoxById(string $boxId): Box
    {
        return Box::find($boxId);
    }

    // vérifie si la box peut être validée
    public static function checkCanValidate(Collection $prestations): bool
    {
        // initialise des variables conteurs
        $catNumber = 0;
        $currentCat = 'noCat';

        // parcours les prestations de la box
        foreach ($prestations as $presta) {
            if ($currentCat !== $presta->categorie->libelle) {
                $currentCat = $presta->categorie->libelle;
                $catNumber++;
            }
        }

        // vérifie s'il y a au moins 2 catégories différentes et au moins 2 prestations
        return ($catNumber >= 2 && sizeof($prestations) >= 2);
    }

    // passe une box à l'état validé
    public static function validateBox(string $boxToken): bool
    {
        // retrouve la box en bd
        $box = Box::where('token', $boxToken)->first();

        // si elle n'existe pas, retourne false
        if ($box === null) {
            return false;
        }

        // change son statut
        $box->statut = Status::VALIDATED;

        // sauvegarde la modification
        return $box->save();
    }

    public static function delPrestation(string $prestaId, string $boxId)
    {
        // récupère la box courante
        $box = Box::find($boxId);
        // lui ajoute la prestation
        self::delMontant($prestaId, $boxId, true);
        $box->prestation()->detach($prestaId);
    }

    public static function addQuantite(string $prestaId, string $boxId)
    {
        // récupère la box courante
        $box = Box::find($boxId);
        // lui ajoute la prestation
        $presta = $box->prestation()->find($prestaId);
        $qty = $presta->pivot->quantite;
        $box->prestation()->updateExistingPivot($presta, ['quantite' => $qty + 1]);
        self::addMontant($prestaId, $boxId);
    }

    public static function delQuantite(string $prestaId, string $boxId)
    {
        // récupère la box courante
        $box = Box::find($boxId);
        // lui ajoute la prestation
        $presta = $box->prestation()->find($prestaId);
        $qty = $presta->pivot->quantite;
        $box->prestation()->updateExistingPivot($presta, ['quantite' => $qty - 1]);
        self::delMontant($prestaId, $boxId, false);
    }

    private static function addMontant(string $prestaId, string $boxId, int $quantite = 1){

        $box = Box::find($boxId);
        $presta = Prestation::find($prestaId);

        $box->montant += ($presta->tarif * $quantite);
        $box->save();
    }

    private static function delMontant(string $prestaId, string $boxId, bool $suppr)
    {
        $box = Box::find($boxId);
        $presta = Prestation::find($prestaId);

        if (!$suppr) {
            $box->montant -= $presta->tarif;
        } else {
            $box->montant = 0;
        }
        $box->save();
    }

    // génère un token pour la box
    public static function generateToken(): string
    {
        $base64 = base64_encode(random_bytes(32));
        $base64 = strtr($base64, '+/', '-_');
        return rtrim($base64, '=');
    }

    // récupère une box avec son token
    public static function getBoxByToken(string $boxToken): Box
    {
        return Box::where('token', $boxToken)->first();
    }

    // confirme le paiement d'une box et change son statut
    public static function confirmerPaiement(string $boxToken): bool
    {
        $box = Box::where('token', $boxToken)->first();
        $box->statut = Status::PAID;
        return $box->save();
    }
}