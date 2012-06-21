<?php

/**
 * Classe da página default.
 * @author      Gabriel
 */
class Page_Passo2 extends Page {

    protected $qtyVars;
    protected $qtyRestrictions;

    public function getQtyVars() {
        return $this->qtyVars;
    }

    public function getQtyRestrictions() {
        return $this->qtyRestrictions;
    }

    /**
     * Retorna o titulo da página
     */
    public function getTitle() {
        return 'Método Simplex - Passo #2';
    }

    /**
     * Método a ser executado antes da página carregar.
     * Verifica se pode continuar.
     */
    public function beforePageLoad() {
        $qtyVars = (int) Core::getPost('qtyVars', 0);
        $qtyRestrictions = (int) Core::getPost('qtyRestrictions', 0);

        $redirect = false;
        if ($qtyVars == 0) {
            $redirect = true;
            $this->addOtherPageMessage('error', 'A quantidade de <b>variáveis</b> deve ser <b>maior que zero.</b>');
        }

        if ($qtyRestrictions == 0) {
            $redirect = true;
            $this->addOtherPageMessage('error', 'A quantidade de <b>restrições</b> deve ser <b>maior que zero</b>.');
        }

        if ($redirect) {
            $this->redirectToPage('Default');
            die;
        }
        $this->qtyVars = $qtyVars;
        $this->qtyRestrictions = $qtyRestrictions;
    }

    /**
     * Retorna o corpo da página default.
     * @return      string
     */
    public function getBody() {
        $this->getPageHtml('passo2/form.php', true);
    }

}

?>
