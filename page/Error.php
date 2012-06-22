<?php

/**
 * Classe da página Error.
 * @author      Gabriel
 */
class Page_Error extends Page {

    public $code;
    public $message;

    /**
     * Retorna o titulo da página
     * @return         string
     */
    public function getTitle() {
        return 'Ocorreu um erro!';
    }

    /**
     * Antes de carregar a página, veja isso.
     */
    public function beforePageLoad() {

        $this->code = Core::getSession('error.code', $default = '404');
        Core::unsSession('error.code');

        $this->message = Core::getSession('error.message', $default = 'Página não encontrada.');
        Core::unsSession('error.message');
    }

    /**
     * Retorna o corpo da página de erro.
     * @author      Gabriel Santos Carvalho
     */
    public function getBody() {
        $this->getPageHtml('error/body.php', true);
    }

}

?>
