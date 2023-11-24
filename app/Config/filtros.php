<?php

/* ----------------------------------------------------------------------
Mapeie no array abaixo o nome do filtro que deseja utilizarpara a classe 
que deve ser utilizada nesse filtro (com namespace completo).
---------------------------------------------------------------------- */

use App\Filtros\Logado;
use App\Filtros\Visitante;

return [
    'visitante' => Visitante::class,
    'logado' => Logado::class,
    'admin' => [
        Logado::class,
        // Admin::class
    ],
];