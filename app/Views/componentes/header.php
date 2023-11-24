<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hermes</title>
    <link rel="stylesheet" href="<?=url_base('hermes.css')?>">
</head>
<body>
        <main>
    <?php if(usuario('logado')): ?>
        <div class="logout">
            <form action="<?=url_base('conta/logout')?>" method="post">
                <button class="neomorfismo" type="submit" >Logout</button>    
            </form>
        </div>
    <?php endif; ?>
