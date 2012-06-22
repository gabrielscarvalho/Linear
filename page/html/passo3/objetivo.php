
<?php $_simplex = $this->getSimplexData(); ?>
<h3>Função Objetivo </h3>
<div class="form-inline">
    <h2>&fnof;(<small><?php echo $_simplex->getObjetivoVarsHtml();  ?></small>) 

        <?php for ($variavelPos = 0; $variavelPos < $_simplex->getQtyVars(); $variavelPos++): ?>
            <?php $sinal = ($variavelPos > 0) ? '+' : ''; ?>
            <?php echo $sinal; ?> <input readonly="true" value="<?php echo $_simplex->getFunObjValor($variavelPos, 0);?>" type="text" name="obj[<?php echo $variavelPos; ?>]" class="input-mini"/> <small>x<?php echo $variavelPos + 1; ?></small>
        <?php endfor; ?>
    </h2>
</div>