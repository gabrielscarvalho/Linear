2<?php

/**
 * Classe da página Passo4.
 * @author      Gabriel
 */
class Page_Passo4 extends Page {

    /**
     * Guarda a informação do simplex.
     * @var         Simplex_Passo3 $_simplexData
     */
    protected $_simplexData;

    /**
     * Retorna o titulo da página
     */
    public function getTitle() {
        return 'Método Simplex - Passo #4';
    }

    /**
     * Método a ser executado antes da página carregar.
     * Verifica se pode continuar.
     */
    public function beforePageLoad() {
        require_once 'lib/Simplex/Core.php';
        require_once 'lib/Simplex/Passo3.php';

        $_passo3 = new Simplex_Passo3();
        $_passo3->setQtyFunctions(Core::getPost('functionQty', 0))
                ->setQtyVars(Core::getPost('varQty', 0))
                ->setFunObj(Core::getPost('obj', array()))
                ->setFunctionEquality(Core::getPost('sign', array()))
                ->setXs(Core::getPost('xs', array()))
                ->setResults(Core::getPost('result', array()))
                ->setBasicIndexes(Core::getPost('basic', array()));


        $this->_simplexData = $_passo3;
    }

    /**
     * Retorna o corpo da página default.
     * @return      string
     */
    public function getBody() {
        #$this->getPageHtml('passo3/form.php', true);
        $this->_simplexData->_printAll();
        
        
    }

    /**
     * Retorna os dados coletados.
     * @return          Simplex_Passo3
     */
    public function getSimplexData() {
        return $this->_simplexData;
    }

}
?>
