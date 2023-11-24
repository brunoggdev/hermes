<?=comp('header')?>

    <?=empty($codigos) ? '<p>Clique no botão abaixo e adicione seu código de rastreamento.</p>' : ''?>
    <div class="adicionar"><a href="codigos/adicionar"><button class="neomorfismo" >➕</button></a></div>

    <?php foreach($codigos as $codigo): ?>
        <?=comp('rastreamento', ['item' => $codigo])?>
    <?php endforeach; ?>

<?=comp('footer')?>