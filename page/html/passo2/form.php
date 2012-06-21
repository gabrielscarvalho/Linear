<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form class="well form-inline" method="post" action="<?php echo Core::getInternalURL('Passo3'); ?>">
    <h1>Método Simplex <small>2º passo.</small></h1> 
    <?php $this->getPageHtml('passo2/objetivo.php', true); ?>
    <hr/>

    <?php for ($linha = 0; $linha < $this->getQtyRestrictions(); $linha++): ?>

        <?php for ($coluna = 0; $coluna < $this->getQtyVars(); $coluna++): ?>
            <?php $sinal = ($coluna > 0) ? '+' : ''; ?>
            <?php echo $sinal; ?> <input placeholder="0" type="text" name="obj[<?php echo $coluna; ?>]" class="input-mini"/> <small>x<?php echo $coluna + 1; ?></small>
        <?php endfor; ?>
            <select name="sign[]" class="input-mini">
                <option value=">="> &gE;</option>
                <option value="<="> &lE;</option>
            </select>
            
            <input type="text" name="obj[<?php echo $linha; ?>]" class="input-mini"/>
        <br/><br/>
    <?php endfor; ?>
</form>

