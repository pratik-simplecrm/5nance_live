<?php /* Smarty version 2.6.11, created on 2018-08-08 10:31:34
         compiled from cache/include/InlineEditing/ContactsEditViewlast_name.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['last_name']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['last_name']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['last_name']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['last_name']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['last_name']['name']; ?>
' size='30' 
    maxlength='100' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >