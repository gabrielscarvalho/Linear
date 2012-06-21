<?php

class Core{
    const URL_BASE = 'localhost/Linear/';
    
    const URL_SKIN = 'localhost/Linear/skin/';
    
    const PAGE_DIR = 'page/';
    
    const PAGE_HTML_DIR = 'page/html/';
    
    /**
     * Retorna uma URL interna
     */
    public static function getUrl($plus){
        return self::URL_BASE. $plus;
    }

    /**
     * Retorna uma URL interna da página de Skin
     */
    public static function getSkinUrl($plus){
        return self::URL_SKIN. $plus;
    }
    
    /**
     * Retorna uma URL interna dos diretórios
     */
    public static function getPageDir($plus){
        return self::PAGE_DIR. $plus;
    }
    
    /**
     * Retorna a página do diretório de html do page dir
     */
    public static function getPageHtml($plus){
        return self::PAGE_HTML_DIR. $plus;
    }
    
    
    
}


