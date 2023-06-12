<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPrestationsByCategorie extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $categorie = PrestationsService::getCategorieById(intval($args['id']))[0];

        $prestations = PrestationsService::getPrestationsByCategorie(intval($args['id']));


        $data = [
            'type' => 'collection',
            'count' => count($prestations),
        ];

        $data['categorie'][] = [
            'categorie' => [
                'id' => $categorie['id'],
                'libelle' => $categorie['libelle'],
                'description' => $categorie['description'],
            ],
            'links' => [
                'self' => [
                    'href' => '/categories/' . $categorie['id'] . '/',
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