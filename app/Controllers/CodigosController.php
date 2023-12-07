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

    
    public function rastrear(string $codigo)
    {
        $html = requisicaoGet("https://www.linkcorreios.com.br?id=$codigo")->resposta();
    
        $regex = '/<div class="singlepost">(.*?<a[^>]*name="envie_por_email"[^>]*>)/s';

    
        if (preg_match($regex, $html, $filtrado)){
            $rastramento = str_replace('linha_status', 'linha_status neomorfismo', $filtrado[1]);
        }else {
            $rastramento = '<p>Nenhum rastreamento encontrado para esse código. Tem certeza que está correto?</p>';
        }

    
        return view('rastreamento', [
            'rastreamento' => $rastramento
        ]);
    }


    public function deletar()
    {
        $codigo = [
            'id' => $this->dadosPost('id_codigo'),
            'id_usuario' => usuario('id')
        ];

        (new CodigosModel)->delete($codigo);

        return redirecionar('home')->com('resposta', 'Codigo deletado com sucesso.');
    }
}