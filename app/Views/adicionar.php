<?=comp('header')?>

    <h3>Novo código</h3>
    
    <main>
        <form action="<?=url_base('/codigos/adicionar')?>" method="post">
            <!-- <label for="codigo">Código de rastreio</label><br> -->
            <input name="codigo" type="text" placeholder="Código de rastreamento" required><br><br>
            <!-- <label for="etiqueta">Etiqueta</label><br> -->
            <input name="etiqueta" type="text" placeholder="Etiqueta"><br><br>
            <button type="submit">Adicionar</button>
            <a href="<?=url_base('home')?>"><button type="button">Voltar</button></a>
        </form>
    </main>

<?=comp('footer')?>