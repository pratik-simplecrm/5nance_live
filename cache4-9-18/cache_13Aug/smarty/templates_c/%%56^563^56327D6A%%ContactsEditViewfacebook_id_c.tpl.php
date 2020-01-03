<?php /* Smarty version 2.6.11, created on 2018-08-10 16:27:41
         compiled from cache/include/InlineEditing/ContactsEditViewfacebook_id_c.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['facebook_id_c']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['facebook_id_c']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['facebook_id_c']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['facebook_id_c']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['facebook_id_c']['name']; ?>
' size='30' 
    maxlength='255' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >