<?php

namespace gift\app\services\authentification;

use Exception;
use gift\app\models\User;

class Authentification
{
    static function connexion($email, $mdp)
    {
        $row = User::where('email', $email);
        if ($row->first()) {
            $user = $row->first();
            if (password_verify($mdp, $user->password)) {
                $_SESSION['user'] = $user;
                return $user;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    static function inscription($email, $mdp, $prenom, $nom) : void
    {
        // vérifie si l'utilisateur existe déjà
        $row = User::where('email', $email);
        if ($row->first()) throw new Exception("Cet email est déjà utilisé");

        // vérifie si le mot de passe est assez fort
        if (!self::checkPassword($mdp)) throw new Exception("Mot de passe non valide : il doit avoir une longueur de 5, contenir
            des minuscules, des majuscules et des chiffres");

        // vérifie si le nom et prénom sont valides
        if (!self::checkString($prenom)) throw new Exception("Caractères invalides dans le prénom");
        if (!self::checkString($nom)) throw new Exception("Caractères invalides dans le nom");

        // crée un nouvel utilisateur
        $hashPassword = password_hash($mdp, PASSWORD_BCRYPT);
        $newRow = new User();
        $newRow->email = $email;
        $newRow->password = $hashPassword;
        $newRow->prenom = $prenom;
        $newRow->nom = $nom;
        $newRow->save();

        // l'enregistre en session
        $user = User::where('email', $email)->first();
        $_SESSION['user'] = $user;
    }

    static function checkPassword($password) : bool
    {
        $filterPassword = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($password != $filterPassword) return false;
        if (strlen($password) < 5) return false;
        if (!preg_match('/[A-Z]/', $password)) return false;
        if (!preg_match('~[0-9]+~', $password)) return false;

        return true;
    }

    static function checkString($str) :bool
    {
        $filterStr = filter_var($str, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($filterStr == $str){
            return true;
        } else {
            return false;
        }
    }
}