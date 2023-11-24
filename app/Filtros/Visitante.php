<?php

namespace App\Filtros;

class Visitante
{
    /**
    * Aplica o filtro configurado
    * @author Brunoggdev
    */
    public function aplicar()
    {
        // Se já estiver logado então não é visitante: redirecionar.
        if (usuario('logado')) {
            return redirecionar('home');
        }
    }
}