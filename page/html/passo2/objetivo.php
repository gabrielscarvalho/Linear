<?php
/**
 * Gera a função objetivo.
 * @author      Gabriel Santos Carvalho
 */
?>
<h3>Função Objetivo </h3>
<div class="form-inline">
    <h2>&fnof;(<small><?php echo $this->getObjetivoVarsHtml() ?></small>) = 

        <?php for ($variavelPos = 0; $variavelPos < $this->getQtyVars(); $variavelPos++): ?>
            <?php $sinal = ($variavelPos > 0) ? '+' : ''; ?>
            <?php echo $sinal; ?> <input type="text" name="obj[<?php echo $variavelPos; ?>]" class="input-mini"/> <small>x<?php echo $variavelPos + 1; ?></small>
        <?php endfor; ?>
    </h2>
</div>