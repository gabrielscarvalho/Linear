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
     * Retorna o corpo
     */
    public function getBody() {
        $page = $this->getPageHtml('default/body.php');
        return file_get_contents($page);
    }
    
}

?>
