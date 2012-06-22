<?php
/**
 * Body que mostrará os erros colhidos.
 * @author      Gabriel Santos Carvalho
 */
?>

<h1>Erro <?php echo $this->code; ?> - <small><?php echo $this->message;?> </small></h1>
<?php
try {
    $this->getPageHtml('error/'.$this->code.'.php', true);
} catch (Exception $e) {
    
}
?>