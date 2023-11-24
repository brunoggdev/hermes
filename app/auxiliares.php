<?php
/* ----------------------------------------------------------------------
Neste aquivo você pode definir suas funções auxiliares com o comportamento
que desejar e elas ficarão disponíveis em toda sua aplicação.
---------------------------------------------------------------------- */


function usuario(string $chave):mixed {
    if (!sessao()->tem('usuario')) {
        return null;
    }

    return sessao('usuario')[$chave];
}


function rastrear(string $codigo):string
{
    $html = requisicaoGet("https://www.linkcorreios.com.br?id=$codigo")->resposta();
    
    $regex = '/<main.*?>(.*?)<a[^>]*name="envie_por_email"[^>]*>/s';

    if (!preg_match($regex, $html, $retorno)){
        throw new Exception('Nenhuma resposta recebida... talvez mais tarde?');
    }

    return $retorno[1];
}