<?php /* Smarty version 2.6.11, created on 2016-10-26 18:11:35
         compiled from cache/modules/AOW_WorkFlow/UsersDetailViewuser_name.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['user_name']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['user_name']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['user_name']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['user_name']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['user_name']['value']; ?>
</span>