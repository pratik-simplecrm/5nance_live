<?php /* Smarty version 2.6.11, created on 2018-08-10 17:03:31
         compiled from cache/include/InlineEditing/ContactsEditViewaddress_c.tpl */ ?>

<?php if (empty ( $this->_tpl_vars['fields']['address_c']['value'] )):  $this->assign('value', $this->_tpl_vars['fields']['address_c']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['address_c']['value']);  endif; ?>  




<textarea  id='<?php echo $this->_tpl_vars['fields']['address_c']['name']; ?>
' name='<?php echo $this->_tpl_vars['fields']['address_c']['name']; ?>
'
rows="2" 
cols="32" 
title='' tabindex="1" 
 ><?php echo $this->_tpl_vars['value']; ?>
</textarea>

