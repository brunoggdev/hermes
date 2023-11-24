<?php
$rotas = new \Hefestos\Rotas\Roteador();
/* ----------------------------------------------------------------------
Cada rota deve ser respondida com o retorno de uma função, seja ela uma
função anonima ou um metodo de controller. Consulte a documentação.
---------------------------------------------------------------------- */


$rotas->get('/', 'ContaController::entrar')->filtro('visitante');

$rotas->agrupar('logado', function() use($rotas) {
    $rotas->get('home', 'CodigosController::index');
    $rotas->get('codigos/adicionar', 'CodigosController::adicionar');
    $rotas->post('codigos/adicionar', 'CodigosController::armazenar');
    $rotas->get('rastrear/{param}', 'CodigosController::rastrear');
    $rotas->delete('codigos/deletar', 'CodigosController::deletar');

    $rotas->post('conta/logout', 'ContaController::logout');
});

$rotas->agrupar('visitante', function($rotas){
    $rotas->get('conta/login', 'ContaController::entrar');
    $rotas->post('conta/login', 'ContaController::login');
    $rotas->get('conta/cadastro', 'ContaController::criar');
    $rotas->post('conta/cadastro', 'ContaController::armazenar');
});