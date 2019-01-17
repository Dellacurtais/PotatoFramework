<?php
use \System\Libraries\HtmlBlocks as HtmlBlocks;
?>
<head lang="<?=\System\FastApp::getInstance()->getConfig("lang")?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

<?php
$block_title = HtmlBlocks::getInstance()->getBlocks("title", 0);
if (!is_null($block_title) && !empty($block_title)){ ?>
    <title><?=$block_title?></title>
<?php }else{ ?>
    <title><?=\System\FastApp::getInstance()->getConfig("name_project")?></title>
<?php } ?>

    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="shortcut icon" type="image/x-icon" href="<?=assets("potato/potato.svg")?>">

<?php
$Blocks = HtmlBlocks::getInstance()->getBlocks("header_block");
if (is_array($Blocks)) {
    foreach ($Blocks as $block) {
        echo $block;
    }
}
?>

</head>
<body>
