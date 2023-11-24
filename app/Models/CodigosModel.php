<?php

namespace App\Models;

use Hefestos\Core\Model;

class CodigosModel extends Model
{
    // tabela do banco de dados ao qual o model está relacionado
    protected string $tabela = 'codigos';


    /**
     * Retorna todos os códigos associados a um usuário.
     * @author Brunoggdev
    */
    public function codigosDoUsuario($id_usuario):array
    {
        return $this
            ->where(['id_usuario' => $id_usuario])
            ->todos();
    }


    /**
     * Adiciona um novo código para o usuário logado
     * @author Brunoggdev
    */
    public function Adicionar(array $dados_codigo)
    {
        return $this->insert($dados_codigo);
    }
}