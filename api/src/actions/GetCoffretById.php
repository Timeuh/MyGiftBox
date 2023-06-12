<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCoffretById extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $box = BoxService::getBoxByID(intval($args['id']))[0];

        $prestations = BoxService::getPrestationsByBox(intval($args['id']));


        $data = [
            'type' => 'collection',
            'count' => count($prestations),
        ];

        $data['Box'][] = [
            'Box' => [
                'id' => $box['id'],
                'libelle' => $box['libelle'],
                'description' => $box['description'],
            ],
            'links' => [
                'self' => [
                    'href' => '/categories/' . $box['id'] . '/',
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