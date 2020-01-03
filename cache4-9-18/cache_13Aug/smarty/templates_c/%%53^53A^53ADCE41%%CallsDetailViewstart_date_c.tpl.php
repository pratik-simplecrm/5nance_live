<?php /* Smarty version 2.6.11, created on 2018-08-06 18:34:07
         compiled from cache/modules/AOW_WorkFlow/CallsDetailViewstart_date_c.tpl */ ?>


    <?php if (strlen ( $this->_tpl_vars['fields']['start_date_c']['value'] ) <= 0): ?>
        <?php $this->assign('value', $this->_tpl_vars['fields']['start_date_c']['default_value']); ?>
    <?php else: ?>
        <?php $this->assign('value', $this->_tpl_vars['fields']['start_date_c']['value']); ?>
    <?php endif; ?>



<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['start_date_c']['name']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>