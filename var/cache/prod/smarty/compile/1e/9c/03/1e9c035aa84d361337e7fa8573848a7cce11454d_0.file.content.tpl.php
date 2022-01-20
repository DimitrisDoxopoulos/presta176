<?php
/* Smarty version 3.1.33, created on 2022-01-20 16:20:42
  from 'C:\laragon\www\presta176\prestadmin\themes\new-theme\template\content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61e96fba6575b6_30429671',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e9c035aa84d361337e7fa8573848a7cce11454d' => 
    array (
      0 => 'C:\\laragon\\www\\presta176\\prestadmin\\themes\\new-theme\\template\\content.tpl',
      1 => 1642679728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61e96fba6575b6_30429671 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="ajax_confirmation" class="alert alert-success" style="display: none;"></div>


<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
  <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }
}
}
