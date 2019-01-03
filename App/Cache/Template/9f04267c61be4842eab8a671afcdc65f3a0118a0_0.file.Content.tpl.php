<?php
/* Smarty version 3.1.30, created on 2018-11-26 21:10:59
  from "/Applications/AMPPS/www/Potato/App/Views/Layout/Content.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bfc7d83a86182_05728764',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f04267c61be4842eab8a671afcdc65f3a0118a0' => 
    array (
      0 => '/Applications/AMPPS/www/Potato/App/Views/Layout/Content.tpl',
      1 => 1541504195,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:Layout/Header.tpl' => 1,
    'file:Layout/Footer.tpl' => 1,
  ),
),false)) {
function content_5bfc7d83a86182_05728764 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['layout']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


<?php $_smarty_tpl->_subTemplateRender("file:Layout/Header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php if ($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'header_title')) {?>

    <?php if ($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'icon_header')) {?>
        <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'icon_header');?>

    <?php } else { ?>
        <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'logo_menu');?>

    <?php }?>

    <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'header_title_top');?>

    <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'header_title');?>


    <?php echo getFlashError();?>

    <?php echo getFlashSuccess();?>

    <?php echo getFlashWarning();?>


<?php }?>

<?php if ($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'content')) {?>
    <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'content');?>

<?php }?>

<?php $_smarty_tpl->_subTemplateRender("file:Layout/Footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
