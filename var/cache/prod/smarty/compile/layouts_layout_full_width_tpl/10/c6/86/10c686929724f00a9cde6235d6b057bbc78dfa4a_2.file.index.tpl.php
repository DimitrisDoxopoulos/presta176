<?php
/* Smarty version 3.1.33, created on 2022-01-20 14:22:26
  from 'C:\laragon\www\presta176\themes\classic\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61e95402a5f960_71385110',
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
function content_61e95402a5f960_71385110 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_181097113261e95402a5ce32_55407553', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_152492945761e95402a5d507_96405043 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_9877986261e95402a5e3e9_87815926 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_167754762461e95402a5de25_01684101 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9877986261e95402a5e3e9_87815926', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_181097113261e95402a5ce32_55407553 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_181097113261e95402a5ce32_55407553',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_152492945761e95402a5d507_96405043',
  ),
  'page_content' => 
  array (
    0 => 'Block_167754762461e95402a5de25_01684101',
  ),
  'hook_home' => 
  array (
    0 => 'Block_9877986261e95402a5e3e9_87815926',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_152492945761e95402a5d507_96405043', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_167754762461e95402a5de25_01684101', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
