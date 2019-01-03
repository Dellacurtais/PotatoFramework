<?php
/* Smarty version 3.1.30, created on 2018-11-26 21:10:59
  from "/Applications/AMPPS/www/Potato/App/Views/Layout/Header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bfc7d83babcf4_91218643',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ee8d19c9f977f50d098d37eda1e01fd1a15a102f' => 
    array (
      0 => '/Applications/AMPPS/www/Potato/App/Views/Layout/Header.tpl',
      1 => 1541504583,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bfc7d83babcf4_91218643 (Smarty_Internal_Template $_smarty_tpl) {
?>
<head lang="<?php echo $_smarty_tpl->tpl_vars['FastApp']->value->getConfig("lang");?>
">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php if ($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'title')) {?>
        <title><?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'title');?>
</title>
    <?php } else { ?>
        <title><?php echo $_smarty_tpl->tpl_vars['FastApp']->value->getConfig("name_project");?>
</title>
    <?php }?>

    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo assets("potato/potato.svg");?>
">

    <?php if ($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'header_block')) {?>
        <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'header_block');?>

    <?php }?>
</head>
<body>
<?php }
}
