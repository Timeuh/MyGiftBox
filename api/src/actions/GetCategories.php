<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCategories extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $categories = PrestationsService::getCategories();

        $data = [
            'type' => 'collection',
            'count' => count($categories),
        ];
        foreach ($categories as $categorie) {
            $data['categories'][] = [
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
        }

        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

}