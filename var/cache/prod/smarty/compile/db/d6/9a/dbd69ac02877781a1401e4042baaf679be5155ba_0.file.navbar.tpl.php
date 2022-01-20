<?php
/* Smarty version 3.1.33, created on 2022-01-20 14:21:44
  from 'C:\laragon\www\presta176\modules\welcome\views\navbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61e953d87a6506_69495588',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dbd69ac02877781a1401e4042baaf679be5155ba' => 
    array (
      0 => 'C:\\laragon\\www\\presta176\\modules\\welcome\\views\\navbar.tpl',
      1 => 1642679733,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61e953d87a6506_69495588 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="onboarding-navbar bootstrap">
  <div class="row text">
    <div class="col-md-8">
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Launch your shop!','d'=>'Modules.Welcome.Admin'),$_smarty_tpl ) );?>

    </div>
    <div class="col-md-4 text-right text-md-right"><?php echo $_smarty_tpl->tpl_vars['percent_rounded']->value;?>
%</div>
  </div>
  <div class="progress">
    <div class="bar" role="progressbar" style="width:<?php echo $_smarty_tpl->tpl_vars['percent_real']->value;?>
%;"></div>
  </div>
  <div>
    <button class="btn btn-main btn-sm onboarding-button-resume"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Resume','d'=>'Modules.Welcome.Admin'),$_smarty_tpl ) );?>
</button>
  </div>
  <div>
    <a class="btn -small btn-main btn-sm onboarding-button-stop"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Stop the OnBoarding','d'=>'Modules.Welcome.Admin'),$_smarty_tpl ) );?>
</a>
  </div>
</div>
<?php }
}
