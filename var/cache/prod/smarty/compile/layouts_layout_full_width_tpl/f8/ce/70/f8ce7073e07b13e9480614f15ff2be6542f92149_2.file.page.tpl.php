<?php
/* Smarty version 3.1.33, created on 2022-01-20 16:20:52
  from 'C:\laragon\www\presta176\themes\classic\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61e96fc4af8ed9_51143048',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8ce7073e07b13e9480614f15ff2be6542f92149' => 
    array (
      0 => 'C:\\laragon\\www\\presta176\\themes\\classic\\templates\\page.tpl',
      1 => 1642679735,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61e96fc4af8ed9_51143048 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_34717769761e96fc4af1e50_89077914', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_133273984161e96fc4af2d07_05112352 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_127959832861e96fc4af2525_53136451 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_133273984161e96fc4af2d07_05112352', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_40807045161e96fc4af6468_89065508 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_111120858661e96fc4af6de8_59688515 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_190976414061e96fc4af5d14_22658308 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_40807045161e96fc4af6468_89065508', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_111120858661e96fc4af6de8_59688515', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_63465479361e96fc4af8040_71248142 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_140425312361e96fc4af7a71_13994161 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_63465479361e96fc4af8040_71248142', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_34717769761e96fc4af1e50_89077914 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_34717769761e96fc4af1e50_89077914',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_127959832861e96fc4af2525_53136451',
  ),
  'page_title' => 
  array (
    0 => 'Block_133273984161e96fc4af2d07_05112352',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_190976414061e96fc4af5d14_22658308',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_40807045161e96fc4af6468_89065508',
  ),
  'page_content' => 
  array (
    0 => 'Block_111120858661e96fc4af6de8_59688515',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_140425312361e96fc4af7a71_13994161',
  ),
  'page_footer' => 
  array (
    0 => 'Block_63465479361e96fc4af8040_71248142',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_127959832861e96fc4af2525_53136451', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_190976414061e96fc4af5d14_22658308', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_140425312361e96fc4af7a71_13994161', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
