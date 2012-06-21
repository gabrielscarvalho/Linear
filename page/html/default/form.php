<form class="well form-inline" method="post" action="<?php echo Core::getInternalURL('Passo2'); ?>">
    <h1>Método Simplex <small>1º passo.</small></h1> 
    <hr/>
    <label>Variáveis</label>&nbsp;&nbsp;
    <input type="text" class="input-small" placeholder="Variáveis" name="qtyVars">
    &nbsp;&nbsp;
    <label>Restrições</label>&nbsp;&nbsp; 
    <input type="text" class="input-small" placeholder="Restrições" name="qtyRestrictions">
    <br/><br/>
    <button type="submit" class="btn btn-primary btn-large">Enviar</button>
</form>
