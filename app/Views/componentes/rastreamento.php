<a class="rastreamento-item neomorfismo" href="<?=url_base("rastrear/$item[codigo]")?>">
    <div>
        <span><?= $item['codigo'] ?></span>
        <p><?= $item['etiqueta'] ?></p>
        <?=abreForm('delete', 'codigos/deletar')?>
            <input type="hidden" name="id_codigo" value="<?=$item['id']?>">
            <button class="deletar-codigo">🗑</button>
        <?=fechaForm()?>
    </div>
</a>