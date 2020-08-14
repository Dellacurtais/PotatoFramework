<?php
/* Smarty version 3.1.33, created on 2020-08-14 06:16:07
  from 'D:\Arquivos e Programas\Ampps\www\Bolsas\App\Views\Error\ErrorHandler.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f365657819127_81994983',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30bb719b74ffa96065521fb9e4171b569f51077e' => 
    array (
      0 => 'D:\\Arquivos e Programas\\Ampps\\www\\Bolsas\\App\\Views\\Error\\ErrorHandler.tpl',
      1 => 1547678233,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f365657819127_81994983 (Smarty_Internal_Template $_smarty_tpl) {
?><table style="border: solid 1px #ff9004; margin: 5px;">
    <tr>
        <td colspan="2" style="border: solid 1px #ff9004">[<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
] <?php echo nl2br($_smarty_tpl->tpl_vars['error']->value);?>
</td>
    </tr>
    <tr>
        <td style="border: solid 1px #ff9004"><?php echo $_smarty_tpl->tpl_vars['Lang']->value->line("handler_error_file");?>
</td>
        <td style="border: solid 1px #ff9004"><?php echo $_smarty_tpl->tpl_vars['file']->value;?>
</td>
    </tr>
    <tr>
        <td style="border: solid 1px #ff9004"><?php echo $_smarty_tpl->tpl_vars['Lang']->value->line("handler_error_line");?>
</td>
        <td style="border: solid 1px #ff9004"><?php echo $_smarty_tpl->tpl_vars['line']->value;?>
</td>
    </tr>
</table><?php }
}
