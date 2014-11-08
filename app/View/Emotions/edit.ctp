<div class="emotions form">
<?php echo $this->Form->create('Emotion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Emotion'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('record_date');
		echo $this->Form->input('my_emotion');
		echo $this->Form->input('my_emotion_val');
		echo $this->Form->input('analyzed_emotion');
		echo $this->Form->input('analyzed_emotion_val');
		echo $this->Form->input('face_emotyion');
		echo $this->Form->input('face_emotyion_val');
		echo $this->Form->input('memo');
		echo $this->Form->input('img1');
		echo $this->Form->input('img_file');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Emotion.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Emotion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Emotions'), array('action' => 'index')); ?></li>
	</ul>
</div>
