<?php

namespace gift\app\services\authentification;

use gift\app\models\User;
use PHPUnit\Logging\Exception;

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

    static function inscription($email, $mdp, $prenom, $nom)
    {
        $row = User::where('email', $email);
        if ($row->first()) return new Exception("Email déjà utilisé");
        if (!self::checkPassword($mdp)) return new Exception("Mot de passe non valide");
        if (!self::checkString($prenom)) return new Exception("Caractères invalides dans le prénom");
        if (!self::checkString($nom)) return new Exception("Caractères invalides dans le nom");
        $hashPassword = password_hash($mdp, PASSWORD_BCRYPT);
        $newRow = new User();
        $newRow->email = $email;
        $newRow->password = $hashPassword;
        $newRow->prenom = $prenom;
        $newRow->nom = $nom;
        $newRow->save();

        $user = User::where('email', $email)->first();
        $_SESSION['user'] = $user;
        return $user;
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