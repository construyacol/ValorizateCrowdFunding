<?php /* Smarty version Smarty-3.1.13, created on 2017-05-04 22:52:43
         compiled from "/Applications/MAMP/htdocs/inventario/modules/inventario/views/producto/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50237400859099a7f8264b1-68755348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57981fd3c6b0b17af0842a87cabf8b3cb891234e' => 
    array (
      0 => '/Applications/MAMP/htdocs/inventario/modules/inventario/views/producto/index.tpl',
      1 => 1493956361,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50237400859099a7f8264b1-68755348',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59099a7f8f8e82_49016878',
  'variables' => 
  array (
    '_acl' => 0,
    '_layoutParams' => 0,
    'productos' => 0,
    'producto' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59099a7f8f8e82_49016878')) {function content_59099a7f8f8e82_49016878($_smarty_tpl) {?>   <div class="row" >
inventario/producto/nuevo" formmethod="POST"><i class="icon-plus"> </i> Nuevo Producto</a>
 $_from = $_smarty_tpl->tpl_vars['productos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['producto']->key => $_smarty_tpl->tpl_vars['producto']->value){
$_smarty_tpl->tpl_vars['producto']->_loop = true;
?>





inventario/producto/editar/<?php echo $_smarty_tpl->tpl_vars['producto']->value['pro_key'];?>
">
inventario/producto/eliminar/<?php echo $_smarty_tpl->tpl_vars['producto']->value['pro_key'];?>
">