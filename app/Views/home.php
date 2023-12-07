<?= comp('header') ?>

    <?= empty($codigos) ? '<p>Clique no botão abaixo e adicione seu código de rastreamento.</p>' : '' ?>
    <div class="adicionar"><a href="codigos/adicionar"><button class="neomorfismo">➕</button></a></div>

    <?php foreach ($codigos as $codigo) : ?>
        <?= comp('rastreamento', ['item' => $codigo]) ?>
    <?php endforeach; ?>


    <?php if (sessao()->tem('resposta')) : ?>

        <div id="toast-container" class="neomorfismo toast-container">
            <p><?= sessao('resposta') ?></p>
        </div>
        <script>
            const toastContainer = document.getElementById('toast-container');
            toastContainer.style.display = 'block';
            setTimeout(function() {
                toastContainer.style.display = 'none';
            }, 3500);
        </script>

    <?php endif; ?>

<?= comp('footer') ?>