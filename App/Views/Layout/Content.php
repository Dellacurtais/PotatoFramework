<?php
    use \System\Libraries\HtmlBlocks as HtmlBlocks;
?>

<?php include BASE_PATH_VIEWS.$layout ?>

<?php include BASE_PATH_VIEWS."Layout/Header.php" ?>


<?php
    $Blocks = HtmlBlocks::getInstance()->getBlocks("header_title", 0);
    if (is_array($Blocks)) {
        foreach ($Blocks as $block) {
            echo $block;
        }
    }
?>


<?php
$block_header_title = HtmlBlocks::getInstance()->getBlocks("header_title", 0);
if (!is_null($block_header_title) && !empty($block_header_title)){
    $block_icon_header = HtmlBlocks::getInstance()->getBlocks("icon_header", 0);
    if (!is_null($block_header_title) && !empty($block_header_title)){
        echo $block_icon_header;
    }else{
        echo HtmlBlocks::getInstance()->getBlocks("logo_menu", 0);
    }

    echo HtmlBlocks::getInstance()->getBlocks("header_title_top", 0);
    echo HtmlBlocks::getInstance()->getBlocks("header_title", 0);

    echo getFlashError();
    echo getFlashSuccess();
    echo getFlashWarning();
}
?>

<?php
    $Blocks = HtmlBlocks::getInstance()->getBlocks("content");
    if (is_array($Blocks)) {
        foreach ($Blocks as $block) {
            echo $block;
        }
    }
?>

<?php include BASE_PATH_VIEWS."Layout/Footer.php" ?>