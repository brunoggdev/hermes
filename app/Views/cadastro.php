<?=comp('header')?>

    <h3>Cadastro</h3>

    <?=comp('erro_conta')?>
    
    <form action="<?=url_base('conta/cadastro')?>" method="post">
        <input type="text" placeholder="Nome" name="nome">
        <br><br>
        <input type="text" placeholder="Login" name="login">
        <br><br>
        <input type="password" placeholder="Senha" name="senha">
        <br><br>
        <button type="submit">Cadastrar</button>
        <a href="<?=url_base('conta/login')?>"><button type="button">Entrar</button></a>
    </form>

<?=comp('footer')?>