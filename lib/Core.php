<?php

class Core {

    const URL_BASE = 'http://localhost/Linear/';
    const URL_SKIN = 'http://localhost/Linear/assets/';
    const PAGE_DIR = 'page/';
    const PAGE_HTML_DIR = 'page/html/';

    /**
     * Retorna uma URL interna
     */
    public static function getBaseUrl($plus = null) {
        return self::URL_BASE . $plus;
    }

    /**
     * Retorna uma URL interna da página de Skin
     */
    public static function getSkinUrl($plus) {
        return self::URL_SKIN . $plus;
    }

    /**
     * Retorna uma URL interna dos diretórios
     */
    public static function getPageDir($plus) {
        return self::PAGE_DIR . $plus;
    }

    /**
     * Retorna a página do diretório de html do page dir
     */
    public static function getPageHtml($plus) {
        return self::PAGE_HTML_DIR . $plus;
    }

    /**
     * Inicia a sessão do projeto
     */
    public static function initSession() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Retorna a url de uma página interna
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     * @param       string $classFileName Qual classe tomará controle da página?
     * @param       array $extra opcional,Os outros parâmetros da url. 
     * @example     $extra = array('var1' => 'valor1','var2' => 'valor2');
     * @return      string
     */
    public static function getInternalURL($classFileName, $extra = array()) {
        $extraUrl = '';
        if (!empty($extra)) {
            foreach ($extra as $field => $value) {
                $extraUrl.= '&' . $field . '=' . $value;
            }
        }
        $url = Core::getBaseUrl('?page=' . $classFileName . $extraUrl);
        return $url;
    }

    /**
     * Redireciona para uma página.
     * @param       string $url O local.
     */
    public static function redirect($url) {
        header("Location: " . $url);
    }

    /**
     * Retorna o post.
     * @param       string $name A variável do $_POST[$name]
     * @param       string $default O que retornar caso não encontre a variável $_POST[$name] ?
     * @return      string
     */
    public static function getPost($name, $default) {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return $default;
    }

}

