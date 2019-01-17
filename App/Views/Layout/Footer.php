<?php
use \System\Libraries\HtmlBlocks as HtmlBlocks;
?>
<?php
$Blocks = HtmlBlocks::getInstance()->getBlocks("footer_block");
foreach ($Blocks as $block){
    echo $block;
}
?>

</body>
</html>