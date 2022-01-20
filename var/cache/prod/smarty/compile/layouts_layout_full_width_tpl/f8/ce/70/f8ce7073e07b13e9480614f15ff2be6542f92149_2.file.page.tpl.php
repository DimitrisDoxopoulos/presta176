<?php
/* Smarty version 3.1.33, created on 2022-01-20 14:03:18
  from 'C:\laragon\www\presta176\themes\classic\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61e94f86ef6832_30761727',
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
function content_61e94f86ef6832_30761727 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_68116559061e94f86eefb82_96121384', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_12038413761e94f86ef0bd7_73412197 extends Smarty_Internal_Block
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
class Block_32317811161e94f86ef0320_38302714 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12038413761e94f86ef0bd7_73412197', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_185487234561e94f86ef3d32_76898360 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_84318198961e94f86ef4624_62527639 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_124320986361e94f86ef36d9_21693315 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_185487234561e94f86ef3d32_76898360', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_84318198961e94f86ef4624_62527639', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_175406383761e94f86ef5950_13501532 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_24772644861e94f86ef5347_42740814 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_175406383761e94f86ef5950_13501532', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_68116559061e94f86eefb82_96121384 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_68116559061e94f86eefb82_96121384',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_32317811161e94f86ef0320_38302714',
  ),
  'page_title' => 
  array (
    0 => 'Block_12038413761e94f86ef0bd7_73412197',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_124320986361e94f86ef36d9_21693315',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_185487234561e94f86ef3d32_76898360',
  ),
  'page_content' => 
  array (
    0 => 'Block_84318198961e94f86ef4624_62527639',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_24772644861e94f86ef5347_42740814',
  ),
  'page_footer' => 
  array (
    0 => 'Block_175406383761e94f86ef5950_13501532',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_32317811161e94f86ef0320_38302714', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_124320986361e94f86ef36d9_21693315', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_24772644861e94f86ef5347_42740814', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
