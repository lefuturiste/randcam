<?php

namespace App\Controllers;

use MongoDB\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RandomController extends Controller
{
	public function getRandom(ServerRequestInterface $request, ResponseInterface $response, \GuzzleHttp\Client $httpClient)
	{
		$randomData = (new \PragmaRX\Random\Random())->size(16)->get();
        $camerasCollection = $this->container->get(Client::class)->randcam->cameras;
        $cameras = $camerasCollection->find([], [
            'limit' => 1,
            'skip' => rand(0, $camerasCollection->countDocuments())
        ]);

        foreach ($cameras as $camera) {
            $responseData = "";
            try {
                $responseData = $httpClient->get($camera['url'])->getBody()->getContents();
            }catch (\Exception $e){
                //delete
                $camerasCollection->deleteOne(['url' => $camera['url']]);
            }

            $randomData .= hash('sha512', $responseData);
        };
		return $response->withJson([
			'success' => true,
			'data' => $randomData
		]);
	}
    public function getRandomCalc($length, ServerRequestInterface $request, ResponseInterface $response, \GuzzleHttp\Client $httpClient)
    {
        $randomData = "";
        $camerasCollection = $this->container->get(Client::class)->randcam->cameras;
        $stop = true;
        while ($stop){
            $cameras = $camerasCollection->find([], [
                'limit' => 1,
                'skip' => rand(0, $camerasCollection->countDocuments())
            ]);

            foreach ($cameras as $camera) {
                $responseData = "";
                try {
                    $responseData = $httpClient->get($camera['url'])->getBody()->getContents();
                }catch (\Exception $e){
                    $camerasCollection->deleteOne(['url' => $camera['url']]);
                }

                $randomData .= hash('sha512', $responseData);
            };

            if (strlen($randomData) >= $length){
                $stop = false;
            }
        }

        return $response->withJson([
            'success' => true,
            'data' => substr($randomData, 0, $length)
        ]);
    }
}
