<?php
require_once "lib/Core.php";
require_once 'lib/Layout.php';
require_once 'lib/Page.php';
$_layout = new Layout();
$_page = $_layout->getPage();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $_page->getTitle();?></title>
    </head>
    <body>
        <?php
        echo $_page->getBody();
        ?>
    </body>
</html>
