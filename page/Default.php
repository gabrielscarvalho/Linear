<?php

/**
 * Classe da página default.
 * @author      Gabriel
 */
class Page_Default extends Page {

    /**
     * Retorna o titulo da página
     */
    public function getTitle() {
        return 'Página Inicial';
    }

    /**
     * Retorna o corpo da página default.
     * @return      string
     */
    public function getBody() {
        return $this->getPageHtml('default/form.php', true);
    }

}

?>
