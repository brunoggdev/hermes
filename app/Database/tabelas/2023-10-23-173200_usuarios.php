<?php

namespace App\Database;

use Hefestos\Database\Tabela;

return ( new Tabela('usuarios') )
    ->id()
    ->string('login', true)
    ->string('senha')
    ->string('nome');