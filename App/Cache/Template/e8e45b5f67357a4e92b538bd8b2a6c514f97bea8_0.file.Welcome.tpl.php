<?php
/* Smarty version 3.1.33, created on 2020-08-14 06:44:03
  from 'D:\Arquivos e Programas\Ampps\www\Bolsas\App\Views\Welcome.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f365ce3c4f441_58066819',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8e45b5f67357a4e92b538bd8b2a6c514f97bea8' => 
    array (
      0 => 'D:\\Arquivos e Programas\\Ampps\\www\\Bolsas\\App\\Views\\Welcome.tpl',
      1 => 1597398049,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f365ce3c4f441_58066819 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "title", null, null);?>Potato Framework<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "header_block", null, null);?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo assets("potato/demo.css");?>
">
<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "logo_menu", null, null);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "header_title_top", null, null);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "header_title", null, null);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "content", null, null);?>
    <!-- CONTENT HERE -->
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand"><img src="<?php echo assets("potato/potato.svg");?>
" height="50px"></h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="https://github.com/Dellacurtais/MicroFramework" target="_blank">GitHub</a>
                </nav>
            </div>
        </header>
        <main role="main" class="inner cover text-center">
            <h1 class="cover-heading">Potato Framework</h1>
            <p class="lead">PF is a Simple Framework build with PHP 7.x</p>
            <p class="lead">
                <a href="https://github.com/Dellacurtais/MicroFramework" class="btn btn-secondary" target="_blank">Documentation</a>
            </p>
        </main>
        <footer class="mastfoot mt-auto text-center">
            <div class="inner">
                <p>Template by <a href="https://getbootstrap.com/">Bootstrap</a>.</p>
            </div>
        </footer>
    </div>
<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "footer_block", null, null);?>
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
}
}
