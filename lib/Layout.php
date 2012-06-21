<?php

/**
 * Faz a parte de escolha da página que vai ser mostrada.
 */
class Layout {

    /**
     * Retorna uma classe da página.
     * @return      Page
     */
    public function getPage() {
        if (isset($_GET['page'])) {
            $class = ucfirst($_GET['page']);
        } else {
            $class = 'Default';
        }
        try {
            return $this->getPageClass($class);
        } catch (Exception $e) {
            return $this->getPageClass('Error');
        }
    }

    /**
     * Retorna a instancia da classe.
     * @param       string $className
     * @return      page or exception
     */
    protected function getPageClass($className) {

        $file = Core::getPageDir($className . '.php');
        if (file_exists($file)) {
            require_once $file;

            $class = 'Page_' . $className;
            if (class_exists($class)) {
                return new $class();
            }else{
                throw new Exception('Classe não encontrada :'.$class);
            }
        }else{
            throw new Exception('Arquivo da classe não existe:'.$className);
        }

        
    }

}

