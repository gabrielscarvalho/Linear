
<form class="well form-inline" method="post" action="<?php echo Core::getInternalURL('Passo4'); ?>">
    <h1>Método Simplex <small>3º passo.</small></h1> 
    <?php $this->getPageHtml('passo3/objetivo.php', true); ?>
    <?php $_simplex = $this->getSimplexData(); ?>


    <hr/>

    <?php for ($linha = 0; $linha < $_simplex->getQtyFunctions(); $linha++): ?>

        <?php for ($coluna = 0; $coluna < $_simplex->getQtyVars(); $coluna++): ?>
            <?php $sinal = ($coluna > 0) ? '+' : ''; ?>
            <?php echo $sinal; ?> <input placeholder="0" type="text" readonly="true" value="<?php echo $_simplex->getXValor($linha, $coluna, 0); ?>" name="xs[<?php echo $linha; ?>][<?php echo $coluna; ?>]" class="input-mini"/> <small>x<?php echo $coluna + 1; ?></small>
        <?php endfor; ?>
        <input type="text" readonly="true" name="sign[<?php echo $linha; ?>]" value="=" class="input-mini" />

        <input type="text" placeholder="0" readonly="true" name="result[<?php echo $linha; ?>]" value="<?php echo $_simplex->getRestricaoResultado($linha, 0); ?>" class="input-mini"/>
        <br/><br/>
    <?php endfor; ?>
    <br/>
    <h3> Variáveis Básicas: <small>Você deve escolher <b><?php echo $_simplex->getQtyFunctions(); ?> variáveis básicas </b>:</small></h3>
    <?php for ($varPos = 0; $varPos < $_simplex->getQtyVars(); $varPos++): ?>
        <input type="checkbox" name="basic[]" value="<?php echo $varPos; ?>" /> <span class="label label-info"><?php echo 'x' . ($varPos + 1); ?></span>
    <?php endfor; ?>
    <br/><br/>
    <input type="submit" class="btn btn-success btn-large" value="Continuar" />
    <input type="hidden" name="varQty" value="<?php echo $_simplex->getQtyVars(); ?>" />
    <input type="hidden" name="functionQty" value="<?php echo $_simplex->getQtyFunctions(); ?>" />

</form>

<script type="text/javascript">
    
    $(function(){
        $("input[type=checkbox]['name=basic[]']").click(function() {

            var bol = $("input[type=checkbox]['name=basic[]']:checked").length >= <?php echo $_simplex->getQtyFunctions(); ?>;     
            $("input[type=checkbox]['name=basic[]']").not(":checked").attr("disabled",bol);

        });
    })
</script>
