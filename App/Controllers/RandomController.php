<?php

namespace App\Controllers;

use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RandomController extends Controller
{
	public function getRandom(ServerRequestInterface $request, ResponseInterface $response)
	{
		$randomData = (new \PragmaRX\Random\Random())->size(32)->get();
		return $response->withJson([
			'success' => true,
			'data' => $randomData
		]);
	}
}
