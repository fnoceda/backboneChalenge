<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\NoSqlController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


// php -S localhost:8000 -t public

// $router->get('/', function () use ($router) { return $router->app->version(); });

// $router->get('/nosql/{id}', function () use ($router) { return NoSqlController::getData($id); });

$router->get('nosql/{id}', 'NoSqlController@index');


$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});
