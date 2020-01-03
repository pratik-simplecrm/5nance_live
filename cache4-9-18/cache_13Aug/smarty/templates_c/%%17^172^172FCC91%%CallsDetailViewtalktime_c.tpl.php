<?php /* Smarty version 2.6.11, created on 2018-08-06 18:34:07
         compiled from cache/modules/AOW_WorkFlow/CallsDetailViewtalktime_c.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_number_format', 'cache/modules/AOW_WorkFlow/CallsDetailViewtalktime_c.tpl', 3, false),)), $this); ?>

<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['talktime_c']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('precision' => 0,'var' => $this->_tpl_vars['fields']['talktime_c']['value']), $this);?>

</span>