<?php

/**
 * Classe de manipulação do terceiro passo do simplex.
 * Esse passo consiste em montar o formulário com todas as variáveis não básicas
 * e remover o sinal de >= ou =<
 * @author      Gabriel Santos Carvalho
 * @version     1.0
 */
class Simplex_Passo3 extends Simplex_Core {
    
    
    /**
     * Adiciona a variável de folga para cada restrição.
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     * @since       21/06/2012
     */
    public function addVariavelFolga() {

        $varPosition = $this->getQtyVars();
        for ($function = 0; $function < $this->getQtyFunctions(); $function++) {
            
            $signal = $this->getRestricaoComparacao($function);
            $this->setXValor($signal == '>=' ? -1 : 1, $function, $varPosition);
            $this->setRestricaoComparacao('=', $function);
            
            $this->setFunObjValor(0, $varPosition);
            $varPosition++;
        }
        $this->qtyVars = $varPosition;
        
    }
    
    
    

}
?>

