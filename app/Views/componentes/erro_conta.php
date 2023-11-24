<?php if (sessao()->tem('erro_conta')) : ?>
    <input class="erro_conta" type="text" readonly value="<?=sessao('erro_conta')?>">
    <br>
<?php endif; ?>