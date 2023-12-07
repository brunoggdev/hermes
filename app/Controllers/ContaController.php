<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use Hefestos\Core\Controller;

class ContaController extends Controller
{
    public function login(?array $usuario = null)
    {
        $usuario ??= $this->dadosPost(['login', 'senha']);

        $usuario_autenticado = (new UsuariosModel)->autenticar(...$usuario);

        if (!$usuario_autenticado) {
            return redirecionar('/conta/login')
                ->com('erro_conta', 'Credenciais inválidas.')
                ->com('login_antigo', $usuario['login']);
        }

        $usuario_autenticado['logado'] = true;
        sessao()->guardar('usuario', $usuario_autenticado);
        
        return redirecionar('home');
    }


    public function logout()
    {
        sessao()->limpar('usuario');
        sessao()->destruir();

        return redirecionar('/');
    }


    public function entrar()
    {
        return view('login');
    }

    public function criar()
    {
        return view('cadastro');
    }

    public function armazenar()
    {
        $usuario = $this->dadosPost(['nome', 'login', 'senha']);

        $usuario_armazenado = (new UsuariosModel)->armazenar($usuario);

        if (!$usuario_armazenado) {
            return redirecionar('conta/cadastro')
                ->com('erro_conta', 'Login indisponível.');
        }

        return $this->login([$usuario['login'], $usuario['senha']]);
    }
}