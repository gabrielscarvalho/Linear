<?php

/**
 * Monta a página
 * 
 */
class Page {

    
    protected function getPageHtml($page){
       $page = Core::getPageHtml($page);
       if(file_exists($page)){
           return $page;
       }
       throw new Exception('A página '.$page.' não foi encontrada.');
    }
    
    /**
     * Ao carregar a página, o que deve ser feito?
     * Utilize para verificações.
     */
    public function beforePageLoad() {
        
    }

    /**
     * Retorna o titulo da página
     */
    public function getTitle() {
        return '';
    }

    /**
     * Retorna o corpo
     */
    public function getBody() {
        return '';
    }

    /**
     * Retorna o rodapé
     */
    public function getFooter() {
        return '';
    }

}

?>
