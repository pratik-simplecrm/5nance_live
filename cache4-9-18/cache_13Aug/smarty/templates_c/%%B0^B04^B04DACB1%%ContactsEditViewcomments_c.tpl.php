<?php /* Smarty version 2.6.11, created on 2018-08-08 14:45:04
         compiled from cache/include/InlineEditing/ContactsEditViewcomments_c.tpl */ ?>

<?php if (empty ( $this->_tpl_vars['fields']['comments_c']['value'] )):  $this->assign('value', $this->_tpl_vars['fields']['comments_c']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['comments_c']['value']);  endif; ?>  




<textarea  id='<?php echo $this->_tpl_vars['fields']['comments_c']['name']; ?>
' name='<?php echo $this->_tpl_vars['fields']['comments_c']['name']; ?>
'
rows="2" 
cols="32" 
title='' tabindex="1" 
 ><?php echo $this->_tpl_vars['value']; ?>
</textarea>

