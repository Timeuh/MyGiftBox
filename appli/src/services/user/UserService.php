<?php

namespace gift\app\services\user;

// service pour les opérations sur les utilisateurs
use gift\app\models\Box;
use PHPUnit\Logging\Exception;

class UserService {

    // vérifie si l'utilisateur a des box modifiables
    public static function checkUserHasEditableBox() : bool {
        // récupère l'utilisateur
        $user = $_SESSION['user'] ?? null;

        // s'il est nul, lance une erreur
        if (!$user){
            throw new Exception('Vous n\'êtes pas connecté');
        }

        // récupère les box de l'utilisateur
        $userBoxes = Box::where("author_id", $_SESSION['user']->email)->get();
        // initialise le retour de la fonction
        $hasEditableBox = false;

        // parcours les box
        foreach($userBoxes as $box){
            if ($hasEditableBox) break;

            // si la box est modifiable, on change le retour de fonction
            if ($box->statut === 1){
                $hasEditableBox = true;
            }
        }

        return $hasEditableBox;
    }
}