<?php

namespace App\Controllers;

use App\Models\CodigosModel;
use Hefestos\Core\Controller;

class CodigosController extends Controller
{
    public function index()
    {
        $id_usuario = usuario('id');

        return view('home', [
            'codigos' => (new CodigosModel)->codigosDoUsuario($id_usuario)
        ]);
    }

       
    public function adicionar()
    {
        return view('adicionar');
    }


    public function armazenar()
    {
        $dados_codigo = [
            'codigo' => $this->dadosPost('codigo'),
            'etiqueta' => $this->dadosPost('etiqueta'),
            'id_usuario' => usuario('id'),
        ];

        $codigo_adicionado = (new CodigosModel)->Adicionar($dados_codigo);

        $resposta = $codigo_adicionado 
        ? 'Codigo adicionado com sucesso.'
        : 'Houve um erro ao adicionar o código.';
        
        return redirecionar('home')->com('resposta', $resposta);
    }

    
    public function rastrear($codigo)
    {
        $html = requisicaoGet("https://www.linkcorreios.com.br?id=$codigo")->resposta();
    
        $regex = '/<main.*?>(.*?)<a[^>]*name="envie_por_email"[^>]*>/s';
    
        if (!preg_match($regex, $html, $retorno)){
            throw new \Exception('Nenhuma resposta recebida... talvez mais tarde?');
        }
    
        return view('rastreamento', [
            'rastreamento' => $retorno[1]
        ]);
    }


    public function deletar()
    {
        $codigo = [
            'id' => $this->dadosPost('id_codigo'),
            'id_usuario' => usuario('id')
        ];

        (new CodigosModel)->delete($codigo);

        return redirecionar('home');
    }
}