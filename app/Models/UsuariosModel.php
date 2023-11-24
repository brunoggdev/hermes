<?php

namespace App\Models;

use Hefestos\Core\Model;

class UsuariosModel extends Model
{
    // tabela do banco de dados ao qual o model está relacionado
    protected string $tabela = 'usuarios';


    /**
     * Tenta autenticar e retonar o usuário, null caso contrário
     * @author Brunoggdev
    */
    public function autenticar(string $login, string $senha):?array
    {
        $usuario = $this->where(['login' => $login])->primeiro();

        $autenticado = !empty($usuario) && password_verify($senha, extrairItem('senha', $usuario));
        
        return $autenticado ? $usuario : null;
    }

    /**
     * Armazena um novo usuário no banco de dados
     * @author Brunoggdev
    */
    public function armazenar(array $usuario)
    {
        $usuario['senha'] = encriptar($usuario['senha']);
        return $this->insert($usuario);
    }
}