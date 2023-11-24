<?php

namespace App\Database;

use Hefestos\Database\Tabela;

return ( new Tabela('codigos') )
    ->id()
    ->int('id_usuario')
    ->string('codigo')
    ->string('etiqueta')
    ->foreignKey('id_usuario', 'usuarios', 'id');