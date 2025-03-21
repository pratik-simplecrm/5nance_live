<?php /* Smarty version 2.6.11, created on 2018-09-04 18:39:16
         compiled from modules/Reminders/tpls/reminders.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'modules/Reminders/tpls/reminders.tpl', 80, false),)), $this); ?>

<?php if ($this->_tpl_vars['remindersDisabled'] == 'false' || ! $this->_tpl_vars['remindersDisabled']): ?>
	<?php $this->assign('REMINDERS_DISABLED', false);  else: ?>
	<?php $this->assign('REMINDERS_DISABLED', true);  endif; ?>

<?php echo '

<style type="text/css">
#reminders #reminder_view .col {float: left; padding-right: 15px;}
#reminders #reminder_view .btns {float: left;}
</style>
'; ?>


<!-- Template for reminders  -->

<div style="display:none;">

	<?php if (! $this->_tpl_vars['REMINDERS_DISABLED']): ?>

	<div id="reminder_template">

		<span class="error-msg"></span>

		<div class="clear"></div>

		<div class="col">
			<label><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_ACTIONS']; ?>
</label>&nbsp;
        </div>

        <div class="clear"></div>

        <div class="col">
			<input type="checkbox" class="popup_chkbox" onclick="Reminders.onPopupChkboxClick(this);"><label><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_POPUP']; ?>
</label>&nbsp;
			<!-- <label><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_WHEN']; ?>
</label> -->
			<select tabindex="0" class="timer_sel_popup" onchange="Reminders.onPopupTimerSelChange(this);">
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['reminder_time']['options']), $this);?>

			</select>
		</div>

        <div class="col">
			<input type="checkbox" class="email_chkbox" onclick="Reminders.onEmailChkboxClick(this);"><label><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_EMAIL']; ?>
</label>&nbsp;
			<!-- <label><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_WHEN']; ?>
</label> -->
			<select tabindex="0" class="timer_sel_email" onchange="Reminders.onEmailTimerSelChange(this);">
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['reminder_time']['options']), $this);?>

			</select>
		</div>

		<div class="clear"></div>

		<div class="col">
			<ul class="invitees_list"></ul>
		</div>

		<div class="clear"></div>

		<div class="btns">
			<input class="add-btn" type="button" value="<?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_ADD_ALL_INVITEES']; ?>
" onclick="Reminders.onAddAllClick(this);">
			<input class="remove-reminder-btn remove-btn" type="button" value="<?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_REMOVE_REMINDER']; ?>
" onclick="Reminders.onRemoveClick(this);">
		</div>

		<div class="clear"></div>
	</div>

	<?php else: ?>

	<div id="reminder_template">

		<span class="error-msg"></span>

		<div class="clear"></div>

		<div class="col">
			<span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_ACTIONS']; ?>
</span>&nbsp;
        </div>

        <div class="clear"></div>

        <div class="col">
			<input type="checkbox" class="popup_chkbox" disabled="disabled"><span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_POPUP']; ?>
</span>&nbsp;
			<!-- <span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_WHEN']; ?>
</span> -->
			<span type="text" class="reminder_when_value" /></span>
			<select tabindex="0" class="timer_sel_popup" disabled="disabled" style="-webkit-appearance: none; -webkit-border-radius: 0px; border: none;">
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['reminder_time_options']), $this);?>

			</select>
		</div>

		<div class="col">
			<input type="checkbox" class="email_chkbox" disabled="disabled"><span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_EMAIL']; ?>
</span>&nbsp;
			<!-- <span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_WHEN']; ?>
</span> -->
			<span type="text" class="reminder_when_value" /></span>
			<select tabindex="0" class="timer_sel_email" disabled="disabled" style="-webkit-appearance: none; -webkit-border-radius: 0px; border: none;">
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['reminder_time_options']), $this);?>

			</select>
		</div>

		<div class="clear"></div>

		<div class="col">
			<ul class="invitees_list disabled"></ul>
		</div>

		<div class="clear"></div>
	</div>

	<?php endif; ?>

</div>
<!-- Reminders field in EditViews -->
<div id="reminders">
	<input type="hidden" id="reminders_data" name="reminders_data" />
	<ul id="reminder_view">
	<?php if ($this->_tpl_vars['REMINDERS_DISABLED']): ?>

        <?php $_from = $this->_tpl_vars['remindersData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['reminder']):
?>

            <ul class="reminder_item" data-reminder-id="<?php echo $this->_tpl_vars['reminder']['id']; ?>
">

                <span class="error-msg"></span>

                <div class="clear"></div>

                <div class="col">
                    <span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_ACTIONS']; ?>
</span>&nbsp;
                </div>

                <div class="clear"></div>

                <div class="col">
                    <input type="checkbox" class="popup_chkbox" disabled="disabled"<?php if ($this->_tpl_vars['reminder']['popup']): ?> checked="checked"<?php endif; ?>><span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_POPUP']; ?>
</span>&nbsp;
                    <!-- <span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_WHEN']; ?>
</span> -->
                    <span type="text" class="reminder_when_value" /></span>
                    <select tabindex="0" class="timer_sel_popup" disabled="disabled" style="-webkit-appearance: none; -webkit-border-radius: 0px; border: none;">
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['reminder_time_options'],'selected' => $this->_tpl_vars['reminder']['timer_popup']), $this);?>

                    </select>
                </div>

                <div class="col">
                    <input type="checkbox" class="email_chkbox" disabled="disabled"<?php if ($this->_tpl_vars['reminder']['email']): ?> checked="checked"<?php endif; ?>><span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_EMAIL']; ?>
</span>&nbsp;
                    <!-- <span><?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_WHEN']; ?>
</span> -->
                    <span type="text" class="reminder_when_value" /></span>
                    <select tabindex="0" class="timer_sel_email" disabled="disabled" style="-webkit-appearance: none; -webkit-border-radius: 0px; border: none;">
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['reminder_time_options'],'selected' => $this->_tpl_vars['reminder']['timer_email']), $this);?>

                    </select>
                </div>

                <div class="clear"></div>

                <div class="col">
                    <ul class="invitees_list disabled">
                    <?php $_from = $this->_tpl_vars['reminder']['invitees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['invitee']):
?>
                        <li class="invitees_item">
                            <button class="invitee_btn" data-invitee-id="<?php echo $this->_tpl_vars['invitees']['id']; ?>
" data-id="<?php echo $this->_tpl_vars['invitee']['module_id']; ?>
" data-module="<?php echo $this->_tpl_vars['invitee']['module']; ?>
" disabled="disabled">
                                <img src="index.php?entryPoint=getImage&amp;themeName=SuiteR+&amp;imageName=Users.gif&quot;">
                                <span class="related-value"> <?php echo $this->_tpl_vars['invitee']['value']; ?>
</span>
                            </button>
                        </li>
                    <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </div>

                <div class="clear"></div>

            </ul>

        <?php endforeach; endif; unset($_from); ?>

	<?php endif; ?>
    </ul>
	<?php if (! $this->_tpl_vars['REMINDERS_DISABLED']): ?>
	<input id="reminder_add_btn" class="add-btn" type="button" value="<?php echo $this->_tpl_vars['MOD']['LBL_REMINDERS_ADD_REMINDER']; ?>
" onclick="Reminders.onAddClick(this);">
	<?php endif; ?>
</div>


<?php if ($this->_tpl_vars['remindersDataJson'] && $this->_tpl_vars['remindersDefaultValuesDataJson'] && $this->_tpl_vars['remindersDisabled']): ?>

	<?php if (! $this->_tpl_vars['REMINDERS_DISABLED']): ?>
	<?php echo '
	<script type="text/javascript">

		$(function(){
			Reminders.loadDefaultsAndInit(';  echo $this->_tpl_vars['remindersDataJson']; ?>
, <?php echo $this->_tpl_vars['remindersDefaultValuesDataJson']; ?>
, <?php echo $this->_tpl_vars['remindersDisabled'];  echo ', \'';  echo $this->_tpl_vars['module'];  echo '\', [{\'personModule\':\'';  echo $this->_tpl_vars['returnModule'];  echo '\', \'personModuleId\':\'';  echo $this->_tpl_vars['returnId'];  echo '\'}], \'';  echo $this->_tpl_vars['returnAction'];  echo '\');
		});

	</script>
	'; ?>

	<?php endif; ?>

<?php else: ?>

	<?php if (! $this->_tpl_vars['REMINDERS_DISABLED']): ?>
	<?php echo '
	<script type="text/javascript">

		$(function(){
			Reminders.loadDefaultsAndInit(null, null, null, \'';  echo $this->_tpl_vars['module'];  echo '\', [{\'personModule\': \'';  echo $this->_tpl_vars['current_user']->module_dir;  echo '\', \'personModuleId\':\'';  echo $this->_tpl_vars['current_user']->id;  echo '\', \'personName\':\'';  echo $this->_tpl_vars['current_user']->name;  echo '\'}, {\'personModule\':\'';  echo $this->_tpl_vars['returnModule'];  echo '\', \'personModuleId\':\'';  echo $this->_tpl_vars['returnId'];  echo '\'}], \'';  echo $this->_tpl_vars['returnAction'];  echo '\');
		});

	</script>
	'; ?>

	<?php endif; ?>

<?php endif; ?>