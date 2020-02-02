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

// Autenticação de usuários
$router->post(
    'auth/login', 
    [
       'uses' => 'AuthController@authenticate'
    ]
);

// Cadastro de usuários
$router->post('users/register', 'Auth\RegisterController@createAPI');

$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
    }
);