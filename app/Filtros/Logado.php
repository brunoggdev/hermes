<?php

namespace App\Filtros;

class Logado
{
    /**
    * Aplica o filtro configurado
    * @author Brunoggdev
    */
    public function aplicar()
    {
        if (!usuario('logado')) {
            return redirecionar('/conta/login')
            ->com('erro_conta', 'Login necessário.');
        }
    }
}