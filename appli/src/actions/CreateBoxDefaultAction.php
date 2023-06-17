<?php

namespace gift\app\actions;

use gift\app\models\Box;
use gift\app\services\box\BoxService;
use gift\app\services\utils\CsrfService;
use PHPUnit\Logging\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// crée une nouvelle box
class CreateBoxDefaultAction extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            // récupère les paramètres du formulaire
            $params = $request->getParsedBody();

            // récupère le token csrf
            $token = $params['csrf'] ?? null;

            // si le token est null lance une exception
            if ($token === null) {
                throw new Exception('Erreur : le token manque');
            }

            // vérifie le token
            CsrfService::check($token);

            // récupère l'id de la box à utiliser comme template
            $idBoxDefault = $params['id'] ?? null;

            // si on ne passe par le paramètre id, c'est qu'on passe par le paramètre template
            if ($idBoxDefault === null){
                $idBoxDefault = $params['template'];
            }

            // crée la box
            $idBox = BoxService::createEmptyBoxReturnId($params);

            // récupère la box crée et celle template
            $box = Box::where("id", $idBox)->first();
            $defBox = Box::where("id", $idBoxDefault)->first();

            // si la box template n'existe pas, lance une exception
            if (!$defBox) {
                throw new Exception("Erreur : La box template n'existe pas");
            }

            // récupère les prestations de la template
            $prestaDefBox = $defBox->prestation()->get();

            // si la box template n'a pas de prestations, lance une exception
            if (!$prestaDefBox) {
                throw new Exception("Erreur : Impossible de retrouver les prestations de la box template");
            }

            // ajoute les prestations de la box template vers la nouvelle box
            foreach ($prestaDefBox as $pa){
                BoxService::addPrestation($pa->id, $idBox);
                for ($i = 0; $i < $defBox->prestation()->where("id", $pa->id)->first()->pivot->quantite; $i++) {
                    BoxService::addQuantite($pa->id, $idBox);
                }
            }

            // charge la vue depuis la template Twig et la retourne
            $view = Twig::fromRequest($request);
            return $view->render($response, 'box.twig', ['boxCreated' => $box]);
        } catch (Exception $e) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'exception.twig', ["error" => $e->getMessage()]);
        }
    }
}