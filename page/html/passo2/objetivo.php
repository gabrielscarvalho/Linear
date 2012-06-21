<?php
/**
 * Gera a função objetivo.
 * @author      Gabriel Santos Carvalho
 */
?>
<h3>Função Objetivo </h3>
<div class="form-inline">
    <h2>&fnof;(<small><?php echo $this->getObjetivoVarsHtml() ?></small>) = 

        <?php for ($i = 0; $i < $this->getQtyVars(); $i++): ?>
            <?php $sinal = ($i > 0) ? '+' : ''; ?>
            <?php echo $sinal; ?> <input type="text" name="obj[<?php echo $i; ?>]" class="input-mini"/> <small>x<?php echo $i + 1; ?></small>
        <?php endfor; ?>
    </h2>
</div>