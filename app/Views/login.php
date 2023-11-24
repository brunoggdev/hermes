<?=comp('header')?>

    <h3>Login</h3>
    
    <?=comp('erro_conta')?>

    <form action="<?=url_base('conta/login')?>" method="post">
        <input type="text" placeholder="Login" name="login" value="<?=sessao('login_antigo')?>" required>
        <br><br>
        <input type="password" placeholder="Senha" name="senha" required>
        <br><br>
        <button type="submit">Entrar</button>
        <a href="<?=url_base('conta/cadastro')?>"><button type="button">Cadastrar</button></a>
    </form>


<?=comp('footer')?>