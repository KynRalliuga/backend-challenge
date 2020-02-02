<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ColorsController extends Controller
{
    private $color;
    private $request;

    public function __construct(Color $color, Request $request){
        $this->color = $color;
        $this->request = $request;
    }

    public function getColors(){
        $retornoJson = [];
        $httpCode = 200;
        try{
            $retornoJson = $this->color->select()->get();
        } catch(QueryException $e){
            $retornoJson = ['erro' => 'Erro de conexão com o BD'];
            $httpCode = 500;
        }

        return response()->json($retornoJson, $httpCode);
    }

    public function storeColor(){
        $retornoJson = [];
        $httpCode = 200;
        try{
            $hex_code_cor = $this->request->hex_code_cor;
            if(!(strpos($hex_code_cor, '#') !== false && strlen($hex_code_cor) == 7)){
                $hex_code_cor = false;
            }

            if($hex_code_cor != false){
                $this->color->nome_cor = $this->request->nome_cor;
                $this->color->hex_code_cor = $hex_code_cor;
    
                if($this->color->save()){
                    $retornoJson = ['msg' => 'Cor registrada com sucesso'];
                    $httpCode = 201;
                }
                else{
                    $retornoJson = ['msg' => 'Ocorreu um erro ao tentar cadastrar a cor'];
                }
            }
            else{
                $retornoJson = ['msg' => 'Código HEX da cor informado incorretamente'];
            }
        } catch(QueryException $e){
            $retornoJson = ['erro' => 'Erro de conexão com o BD'];
            $httpCode = 500;
        }

        return response()->json($retornoJson, $httpCode);
    }

    public function updateColor(){
        $retornoJson = [];
        $httpCode = 200;
        try{
            $hex_code_cor = $this->request->hex_code_cor;
            if(!(strpos($hex_code_cor, '#') !== false && strlen($hex_code_cor) == 7)){
                $hex_code_cor = false;
            }

            if($hex_code_cor != false){
                $atualizou_cor = $this->color->where('id', $this->request->id)->update([
                    'nome_cor' => $this->request->nome_cor,
                    'hex_code_cor' => $hex_code_cor,
                ]);

                if($atualizou_cor){
                    $retornoJson = ['msg' => 'Cor atualizada com sucesso'];
                }
                else{
                    $retornoJson = ['msg' => 'Ocorreu um erro ao tentar atualizar a cor'];
                }
            }
            else{
                $retornoJson = ['msg' => 'Código HEX da cor informado incorretamente'];
            }
        } catch(QueryException $e){
            $retornoJson = ['erro' => 'Erro de conexão com o BD'];
            $httpCode = 500;
        }

        return response()->json($retornoJson, $httpCode);
    }

    public function deleteColor(){
        $retornoJson = [];
        $httpCode = 200;
        try{
            $deletou_cor = $this->color->where('id', $this->request->id)->delete();

            if($deletou_cor){
                $retornoJson = ['msg' => 'Cor deletada com sucesso'];
            }
            else{
                $retornoJson = ['msg' => 'Ocorreu um erro ao tentar deletar a cor'];
            }
        } catch(QueryException $e){
            $retornoJson = ['erro' => $e];
            $httpCode = 500;
        }

        return response()->json($retornoJson, $httpCode);
    }
}
