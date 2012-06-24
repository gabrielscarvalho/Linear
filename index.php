<?php
require_once "lib/Core.php";
require_once 'lib/Layout.php';
require_once 'lib/Page.php';
Core::initSession();
$_layout = new Layout();
$_page = $_layout->getPage();
$_page->beforePageLoad();
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $_page->getTitle(); ?></title>
        <?php $_page->getScriptnCss(); ?>
    </head>
    <body>
        <div>
            <div class="page-header">
                <?php $_page->getHeader(); ?>
            </div>
            <div class="container-fluid" >
                <?php echo $_page->getMessagesBlockHtml(); //As mensagens geradas.  ?>
                <?php $_page->getBody(); ?>
            </div>
            <hr/>
            <footer>
                <?php $_page->getFooter(); ?>
            </footer>
        </div>
    </body>
</html>
