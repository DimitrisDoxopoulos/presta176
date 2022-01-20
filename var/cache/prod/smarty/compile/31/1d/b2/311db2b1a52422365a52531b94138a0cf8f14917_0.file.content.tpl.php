<?php
/* Smarty version 3.1.33, created on 2022-01-20 14:21:43
  from 'C:\laragon\www\presta176\prestadmin\themes\default\template\content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61e953d79b4241_89783813',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '311db2b1a52422365a52531b94138a0cf8f14917' => 
    array (
      0 => 'C:\\laragon\\www\\presta176\\prestadmin\\themes\\default\\template\\content.tpl',
      1 => 1642679729,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61e953d79b4241_89783813 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="ajax_confirmation" class="alert alert-success hide"></div>
<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div>
<?php }
}
