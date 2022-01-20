<?php
/* Smarty version 3.1.33, created on 2022-01-20 16:20:52
  from 'C:\laragon\www\presta176\themes\classic\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61e96fc4a41f72_04546784',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10c686929724f00a9cde6235d6b057bbc78dfa4a' => 
    array (
      0 => 'C:\\laragon\\www\\presta176\\themes\\classic\\templates\\index.tpl',
      1 => 1642679735,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61e96fc4a41f72_04546784 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_89127381661e96fc4a3e8b3_63433634', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_131241095561e96fc4a3f212_04845775 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_30878232761e96fc4a40414_90861623 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_137319641061e96fc4a3fcf2_61924575 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_30878232761e96fc4a40414_90861623', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_89127381661e96fc4a3e8b3_63433634 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_89127381661e96fc4a3e8b3_63433634',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_131241095561e96fc4a3f212_04845775',
  ),
  'page_content' => 
  array (
    0 => 'Block_137319641061e96fc4a3fcf2_61924575',
  ),
  'hook_home' => 
  array (
    0 => 'Block_30878232761e96fc4a40414_90861623',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_131241095561e96fc4a3f212_04845775', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_137319641061e96fc4a3fcf2_61924575', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
