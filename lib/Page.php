<?php

/**
 * Classe de geração das páginas no projeto.
 * @author      Gabriel Santos Carvalho
 * @version     1.0
 * @since       21/06/2012
 */
class Page {

    /**
     * Monstrará mensagens na página ?
     * @var         bool $showMensagem
     */
    public $showMensagem = false;

    /**
     * O array das mensagens.
     * @var         array $mensagens
     * @example     array( 'error'  => array('Erro1','Erro2','Erro3')
     */
    protected $mensagens;

    /**
     * O array das mensagens de outras páginas.
     * @var         array $mensagensFora
     * @example     array( 'error'  => array('Erro1','Erro2','Erro3')
     */
    protected $mensagensFora;

    /**
     * Verifica se uma página existe para ser colocada no html
     * @return      string or exception
     */
    protected function getPageHtml($page, $requirePage = false) {
        $page = Core::getPageHtml($page);
        if (file_exists($page)) {
            if ($requirePage) {
                require_once $page;
            }
            return $page;
        }
        throw new Exception('A página ' . $page . ' não foi encontrada.');
    }

    /**
     * Redireciona para uma página.
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     * @param       string $classFileName Qual classe tomará controle da página?
     */
    protected function redirectToPage($classFileName, $extra = array()) {
        $url = Core::getInternalURL($classFileName, $extra);
        Core::redirect($url);
    }

    /**
     * Ao carregar a página, o que deve ser feito?
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     */
    public function beforePageLoad() {
        
    }

    /**
     * Retorna o head da página
     * @return      string
     */
    public function getScriptnCss() {
        $this->getPageHtml('page/head.php', true);
    }

    /**
     * Retorna o titulo da página
     * @return      string
     */
    public function getTitle() {
        return '';
    }

    /**
     * Retorna o cabeçalho do site
     * @return      string
     */
    public function getHeader() {
        $this->getPageHtml('page/header.php', true);
    }

    /**
     * Retorna o corpo do site
     * @return      string
     */
    public function getBody() {
        echo '';
    }

    /**
     * Retorna o rodapé.
     * @return      string
     */
    public function getFooter() {
        $this->getPageHtml('page/footer.php', true);
    }

    /**
     * Adiciona uma mensagem para ser exibida na tela.
     * @param       string $type O tipo da mensagem (info, error, success)
     * @param       string $message A mensagem
     */
    protected function addMensagem($type = 'info', $message) {
        if (in_array($type, array('info', 'success', 'error'))) {
            $this->showMensagem = true;
            $this->mensagens[$type][] = $message;
            return;
        }
        throw new Exception('Tipo da mensagem :' . $type . ' é desconhecido');
    }

    /**
     * Retorna o HTML das mensagens adicionadas.
     * @return      string HTML
     */
    public function getMessagesBlockHtml() {
        $html = '';

        //Verificamos se temos mensagens de fora.
        $this->checkOtherPageMessages();

        if ($this->showMensagem == true) {
            if (!empty($this->mensagens)) {

                foreach ($this->mensagens as $tipo => $mensagens) {
                    $html.='<div class="alert alert-' . $tipo . '">';
                    foreach ($mensagens as $mensagem) {
                        $html.= $mensagem . '<br/>';
                    }
                    $html.='</div>';
                }
            }
            
            if (!empty($this->mensagensFora)) {

                foreach ($this->mensagensFora as $tipo => $mensagens) {
                    $html.='<div class="alert alert-' . $tipo . '">';
                    foreach ($mensagens as $mensagem) {
                        $html.= $mensagem . '<br/>';
                    }
                    $html.='</div>';
                }
            }
            

            $this->showMensagem = false;
            $this->mensagens = array();
        }


        return $html;
    }

    /**
     * Verifica se há mensagens de outras páginas.
     * @return      void
     */
    protected function checkOtherPageMessages() {
        
        $this->mensagensFora = array();
        if (isset($_SESSION['page.messages'])) {
            if (!empty($_SESSION['page.messages'])) {
                $this->showMensagem = true;
                $this->mensagensFora = $_SESSION['page.messages'];
            }
        }
        $_SESSION['page.messages'] = array();
    }

    /**
     * Adiciona variáveis para outra página.
     */
    protected function addOtherPageMessage($type='info', $message) {

        if (!isset($_SESSION['page.messages'])) {
            $_SESSION['page.messages'] = array();
        }

        $msgs = $_SESSION['page.messages'];
        if (!is_array($msgs)) {
            $msgs = array();
        }
        if (in_array($type, array('info', 'success', 'error'))) {
            $msgs[$type][] = $message;
        }
        $_SESSION['page.messages'] = $msgs;
        
        
    }

    /**
     * Mata a página, redirecionando para a página de erro.
     * @param       string $code O código do erro.
     * @param       string $reason O motivo que você precisou matar a página.
     * @return      void
     * Esse método só deve ser usado dentro do beforeLoad
     */
    protected function killPage($code, $reason) {
        $_SESSION['error.code'] = $code;
        $_SESSION['error.message'] = $reason;
        $this->redirect('Error');
    }

}

?>
