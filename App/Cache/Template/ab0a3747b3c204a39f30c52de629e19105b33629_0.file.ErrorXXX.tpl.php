<?php
/* Smarty version 3.1.33, created on 2020-08-14 05:50:45
  from 'D:\Arquivos e Programas\Ampps\www\Bolsas\App\Views\Error\ErrorXXX.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f36506533d026_08321599',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab0a3747b3c204a39f30c52de629e19105b33629' => 
    array (
      0 => 'D:\\Arquivos e Programas\\Ampps\\www\\Bolsas\\App\\Views\\Error\\ErrorXXX.tpl',
      1 => 1547678233,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f36506533d026_08321599 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['FastApp']->value->getConfig("lang");?>
">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_smarty_tpl->tpl_vars['Lang']->value->line("error404");?>
</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Passion+One:900" rel="stylesheet">
</head>
<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1 style="color: #6e0100">!</h1>
            </div>
            <h2>Error <?php echo $_smarty_tpl->tpl_vars['Excpetion']->value->getCode();?>
</h2>
            <p><?php echo nl2br($_smarty_tpl->tpl_vars['Excpetion']->value->getMessage());?>
</p>
            <table>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['Lang']->value->line("handler_error_file");?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['Excpetion']->value->getFile();?>
</td>
                </tr>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['Lang']->value->line("handler_error_line");?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['Excpetion']->value->getLine();?>
</td>
                </tr>
            </table>
        </div>
    </div>
    <style scoped>
            .notfound a,.notfound h2{ text-transform:uppercase}*{ -webkit-box-sizing:border-box;box-sizing:border-box}body{ padding:0;margin:0}#notfound{ position:relative;height:100vh}#notfound .notfound{ position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.notfound{ max-width:710px;width:100%;padding-left:190px;line-height:1.4}.notfound .notfound-404{ position:absolute;left:0;top:0;width:150px;height:150px}.notfound .notfound-404 h1{ font-family:'Passion One',cursive;color:#00b5c3;font-size:150px;letter-spacing:-27.5px;margin:0;font-weight:900;position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}.notfound h2{ font-family:Raleway,sans-serif;color:#292929;font-size:28px;font-weight:700;letter-spacing:2.5px;margin-top:0}.notfound a,.notfound p{ font-family:Raleway,sans-serif;font-size:14px}.notfound p{ font-weight:400;margin-top:0;margin-bottom:15px;color:#333}.notfound a{ text-decoration:none;background:#fff;display:inline-block;padding:15px 30px;border-radius:40px;color:#292929;font-weight:700;-webkit-box-shadow:0 4px 15px -5px rgba(0,0,0,.3);box-shadow:0 4px 15px -5px rgba(0,0,0,.3);-webkit-transition:.2s all;transition:.2s all}.notfound a:hover{ color:#fff;background-color:#00b5c3}@media only screen and (max-width:480px){ .notfound{ text-align:center;padding-left:15px;padding-right:15px}.notfound .notfound-404{ position:relative;width:100%;margin-bottom:15px}}
        </style>
    </body>
</html>
<?php }
}