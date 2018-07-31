<?php

namespace App\Controllers;

use MongoDB\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CameraController extends Controller
{
    public function getCameras(ServerRequestInterface $request, ResponseInterface $response, \GuzzleHttp\Client $httpClient)
    {
        $camerasCollection = $this->container->get(Client::class)->randcam->cameras;
        $cameras = array_map(function ($item) {
            return $item['url'];
        }, $camerasCollection->find()->toArray());

        return $response->withJson([
            'success' => true,
            'data' => $cameras
        ]);
    }
}
