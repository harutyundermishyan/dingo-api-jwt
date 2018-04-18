<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->get('/home', function ()
    {
        return 'working';
    });
    $api->resource('/products', 'App\Http\Controllers\ProductController');
    $api->resource('/models', 'App\Http\Controllers\ModelController');
    $api->resource('/brands', 'App\Http\Controllers\BrandController');
    $api->resource('/categories', 'App\Http\Controllers\CategoryController');
    $api->post('/auth', 'App\Http\Controllers\Auth\AuthenticateController@authenticate');
    $api->post('/register', 'App\Http\Controllers\Auth\ApiRegisterController@register');
});