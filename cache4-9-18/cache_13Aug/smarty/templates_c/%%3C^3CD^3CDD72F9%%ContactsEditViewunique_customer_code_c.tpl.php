<?php /* Smarty version 2.6.11, created on 2018-08-07 14:06:22
         compiled from cache/include/InlineEditing/ContactsEditViewunique_customer_code_c.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['unique_customer_code_c']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['unique_customer_code_c']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['unique_customer_code_c']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['unique_customer_code_c']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['unique_customer_code_c']['name']; ?>
' size='30' 
    maxlength='100' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >