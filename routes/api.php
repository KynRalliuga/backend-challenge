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

// Cadastro de usuários
$router->post('users/register', 'Auth\RegisterController@createAPI');

// Autenticação de usuários
$router->post(
    'auth/login', 
    [
       'uses' => 'AuthController@authenticate'
    ]
);

$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        // Produtos
        $router->get('products/list', 'ProductsController@getProducts'); // Lista Produtos
        $router->post('products/register', 'ProductsController@storeProduct'); // Cadastra Produto
        $router->put('products/update', 'ProductsController@updateProduct'); // Atualiza Produto
        $router->delete('products/delete', 'ProductsController@deleteProduct'); // Deleta Produto

        // Cores
        $router->get('colors/list', 'ColorsController@getColors'); // Lista Cores
        $router->post('colors/register', 'ColorsController@storeColor'); // Cadastra Cor
        $router->put('colors/update', 'ColorsController@updateColor'); // Atualiza Cor
        $router->delete('colors/delete', 'ColorsController@deleteColor'); // Deleta Cor
    }
);