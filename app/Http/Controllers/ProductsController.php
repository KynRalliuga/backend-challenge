<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Firebase\JWT\JWT;

class ProductsController extends Controller
{
    private $product;
    private $request;

    public function __construct(Product $product, Request $request){
        $this->product = $product;
        $this->request = $request;
    }

    public function getProducts(){
        $retornoJson = [];
        $httpCode = 200;
        try{
            $retornoJson = $this->product->select(
                'products.id',
                'products.titulo as titulo_produto',
                'products.descricao as descricao_produto',
                'products.quantidade as quantidade_produto',
                'products.cores_array',
                'colors.nome_cor',
                'colors.hex_code_cor',
                'users.name as nome_usuario',
                'users.email as email_usuario'
            )->join('colors', 'colors.id', '=', 'products.color_id')
            ->join('users', 'users.id', '=', 'products.user_id')->get();
        } catch(QueryException $e){
            $retornoJson = ['erro' => 'Erro de conexão com o BD'];
            $httpCode = 500;
        }

        return response()->json($retornoJson, $httpCode);
    }

    public function storeProduct(){
        $retornoJson = [];
        $httpCode = 200;
        try{
            $cores_array_json = $this->request->cores_array;
            if(!(is_array($cores_array_json) && $cores_array_json != null)){
                $cores_array_json = [];
            }
            $cores_array_json = json_encode($cores_array_json);
            $user_id = JWT::decode($this->request->bearerToken(), env('JWT_SECRET'), ['HS256'])->sub;
            
            $this->product->titulo = $this->request->titulo;
            $this->product->descricao = $this->request->descricao;
            $this->product->quantidade = $this->request->quantidade;
            $this->product->cores_array = $cores_array_json;
            $this->product->color_id = $this->request->color_id;
            $this->product->user_id = $user_id;

            if($this->product->save()){
                $retornoJson = ['msg' => 'Produto registrado com sucesso'];
                $httpCode = 201;
            }
            else{
                $retornoJson = ['msg' => 'Ocorreu um erro ao tentar cadastrar o produto'];
            }
        } catch(QueryException $e){
            $retornoJson = ['erro' => 'Erro de conexão com o BD'];
            $httpCode = 500;
        }

        return response()->json($retornoJson, $httpCode);
    }

    public function updateProduct(){
        $retornoJson = [];
        $httpCode = 200;
        try{
            $cores_array_json = $this->request->cores_array;
            if(!(is_array($cores_array_json) && $cores_array_json != null)){
                $cores_array_json = [];
            }
            $cores_array_json = json_encode($cores_array_json);
            $user_id = JWT::decode($this->request->bearerToken(), env('JWT_SECRET'), ['HS256'])->sub;

            $atualizou_produto = $this->product->where('id', $this->request->id)->update([
                'titulo' => $this->request->titulo,
                'descricao' => $this->request->descricao,
                'quantidade' => $this->request->quantidade,
                'cores_array' => $cores_array_json,
                'color_id' => $this->request->color_id,
                'user_id' => $user_id,
            ]);

            if($atualizou_produto){
                $retornoJson = ['msg' => 'Produto atualizado com sucesso'];
            }
            else{
                $retornoJson = ['msg' => 'Ocorreu um erro ao tentar atualizar o produto'];
            }
        } catch(QueryException $e){
            $retornoJson = ['erro' => 'Erro de conexão com o BD'];
            $httpCode = 500;
        }

        return response()->json($retornoJson, $httpCode);
    }

    public function deleteProduct(){
        $retornoJson = [];
        $httpCode = 200;
        try{
            $deletou_produto = $this->product->where('id', $this->request->id)->delete();

            if($deletou_produto){
                $retornoJson = ['msg' => 'Produto deletado com sucesso'];
            }
            else{
                $retornoJson = ['msg' => 'Ocorreu um erro ao tentar deletar o produto'];
            }
        } catch(QueryException $e){
            $retornoJson = ['erro' => 'Erro de conexão com o BD'];
            $httpCode = 500;
        }

        return response()->json($retornoJson, $httpCode);
    }
}
