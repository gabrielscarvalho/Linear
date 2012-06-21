<?php
/**
 * Classe da página Error.
 * @author      Gabriel
 */
class Page_Error extends Page{
    
    protected $code;
    protected $message;
    
     /**
     * Retorna o titulo da página
     */
    public function getTitle() {
        return 'Ocorreu um erro!';
    }
    
    public function beforePageLoad() {
        if(isset($_SESSION['error.code'])){
            $this->code = $_SESSION['error.code'];
            unset($_SESSION['error.code']);
        }
        
        if(isset($_SESSION['error.message'])){
            $this->message = $_SESSION['error.message'];
            unset($_SESSION['error.message']);
        }
    }
    
    
    public function getBody() {
        return $this->code.' - '.$this->message;
    }
    
    
}
?>
