<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCoffretById extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $box = BoxService::getBoxByID($args['id'])[0];

        $prestations = BoxService::getPrestationsByBox($args['id']);


        $data = [
            'type' => 'collection',
            'count' => count($prestations),
        ];

        $data['Box'][] = [
            'Box' => [
                'id' => $box['id'],
                'token' => $box['token'],
                'libelle' => $box['libelle'],
                'description' => $box['description'],
                'montant' => $box['montant'],
                'kdo' => $box['kdo'],
                'message_kdo' => $box['message_kdo'],
                'statut' => $box['statut'],
            ],
            'links' => [
                'self' => [
                    'href' => '/box/view/' . $box['token'],
                ]
            ]
        ];

        foreach ($prestations as $prestation) {
            $data['prestations'][] = [
                'prestation' => [
                    'id' => $prestation['id'],
                    'libelle' => $prestation['libelle'],
                    'unite' => $prestation['unite'],
                    'tarif' => $prestation['tarif'],
                    'img' => $prestation['img'],
                    'cat_id' => $prestation['cat_id'],
                    'quantite' => $prestation->pivot->quantite,
                    'date' => $prestation->pivot->date,
                ],
                'links' => [
                    'self' => [
                        'href' => '/prestation/' . $prestation['id'],
                    ]
                ]
            ];
        }

        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

}