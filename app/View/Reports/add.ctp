<div class="reports form">
<?php echo $this->Form->create('Report'); ?>
	<fieldset>
		<legend><?php echo __('Add Report'); ?></legend>
	<?php
		echo $this->Form->input('report_date');
		echo $this->Form->input('employee');
		echo $this->Form->input('activity');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reports'), array('action' => 'index')); ?></li>
	</ul>
</div>
