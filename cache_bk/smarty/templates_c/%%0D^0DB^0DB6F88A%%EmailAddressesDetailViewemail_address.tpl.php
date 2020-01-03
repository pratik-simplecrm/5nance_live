<?php /* Smarty version 2.6.11, created on 2016-10-26 18:11:44
         compiled from cache/modules/AOW_WorkFlow/EmailAddressesDetailViewemail_address.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['email_address']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['email_address']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['email_address']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['email_address']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['email_address']['value']; ?>
</span>