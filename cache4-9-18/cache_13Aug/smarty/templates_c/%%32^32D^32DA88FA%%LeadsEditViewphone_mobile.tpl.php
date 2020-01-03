<?php /* Smarty version 2.6.11, created on 2018-08-08 16:55:46
         compiled from cache/include/InlineEditing/LeadsEditViewphone_mobile.tpl */ ?>


<?php if (strlen ( $this->_tpl_vars['fields']['phone_mobile']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['phone_mobile']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['phone_mobile']['value']);  endif; ?>  

<input type='text' name='<?php echo $this->_tpl_vars['fields']['phone_mobile']['name']; ?>
' id='<?php echo $this->_tpl_vars['fields']['phone_mobile']['name']; ?>
' size='30' maxlength='10' value='<?php echo $this->_tpl_vars['value']; ?>
' title='' tabindex='1'	  class="phone" >