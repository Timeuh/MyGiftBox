<?php

namespace gift\app\services\utils;

use Exception;

class CsrfService {

    // génère un token csrf
    public static function generate() : array {
        try {
            // génère le token
            $token = bin2hex(random_bytes(32));
            // le stocke en session
            $_SESSION['csrf'] = $token;
            // retourne le token avec le bon statut
            return ['status' => 200, 'message' => 'Token généré', 'token' => $token];
        } catch (Exception $e) {
            // retourne l'erreur
            return ['status' => 500, 'message' => 'Erreur de génération du token'];
        }
    }

    /**
     * Vérifie que le token correspond à celui de la session
     *
     * @throws Exception lorsque le token n'est pas présent ou ne correspond pas
     */
    public static function check(string $token) : bool {
        // si le token n'existe pas en session
        if (!isset($_SESSION['csrf'])){
            // lance une exception
            throw new Exception('Vous n\'avez pas de token en session');
        }

        // récupère le token en session
        $userToken = $_SESSION['csrf'];

        // si le token de session ne correspond pas a celui de l'argument
        if ($token !== $userToken){
            // supprime le token en session
            unset($_SESSION['csrf']);
            // lance une exception
            throw new Exception('Les tokens ne correspondent pas');
        }

        // si tous les contrôles sont passés, le token est valide
        return true;
    }
}