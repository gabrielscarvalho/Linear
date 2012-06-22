<form class="well form-inline" method="post" action="<?php echo Core::getInternalURL('Passo3'); ?>">
    <h1>Método Simplex <small>2º passo.</small></h1> 
    <?php $this->getPageHtml('passo2/objetivo.php', true); ?>
    <hr/>

    <?php for ($linha = 0; $linha < $this->getQtyRestrictions(); $linha++): ?>

        <?php for ($coluna = 0; $coluna < $this->getQtyVars(); $coluna++): ?>
            <?php $sinal = ($coluna > 0) ? '+' : ''; ?>
            <?php echo $sinal; ?> <input placeholder="0" type="text" name="xs[<?php echo $linha;?>][<?php echo $coluna; ?>]" class="input-mini"/> <small>x<?php echo $coluna + 1; ?></small>
        <?php endfor; ?>
            <select name="sign[<?php echo $linha; ?>]" class="input-mini">
                <option value=">="> &gE;</option>
                <option value="<="> &lE;</option>
            </select>
            
            <input type="text" placeholder="0" name="result[<?php echo $linha; ?>]" class="input-mini"/>
        <br/><br/>
    <?php endfor; ?>
        <input type="hidden" name="varQty" value="<?php echo $this->getQtyVars();?>" />
        <input type="hidden" name="functionQty" value="<?php echo $this->getQtyRestrictions();?>" />
        <input type="submit" class="btn btn-success btn-large" value="Continuar" />
</form>

