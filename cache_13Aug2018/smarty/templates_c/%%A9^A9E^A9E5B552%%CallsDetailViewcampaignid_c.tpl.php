<?php /* Smarty version 2.6.11, created on 2018-08-13 10:55:11
         compiled from cache/modules/AOW_WorkFlow/CallsDetailViewcampaignid_c.tpl */ ?>


<?php if (is_string ( $this->_tpl_vars['fields']['campaignid_c']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['campaignid_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['campaignid_c']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['campaignid_c']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['campaignid_c']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['campaignid_c']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['campaignid_c']['options'][$this->_tpl_vars['fields']['campaignid_c']['value']]; ?>

<?php endif; ?>