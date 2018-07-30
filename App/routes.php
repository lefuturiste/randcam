<?php
/*
|--------------------------------------------------------------------------
| Api routing
|--------------------------------------------------------------------------
|
| Register it all your api routes
|
*/
$app->get('/', [\App\Controllers\PagesController::class, 'getHome']);
$app->get('/random', [\App\Controllers\RandomController::class, 'getRandom']);
