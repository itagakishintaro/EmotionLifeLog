<div class="emotions view">
<h2><?php echo __('Emotion'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Record Date'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['record_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('My Emotion'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['my_emotion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('My Emotion Val'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['my_emotion_val']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Analyzed Emotion'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['analyzed_emotion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Analyzed Emotion Val'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['analyzed_emotion_val']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Face Emotyion'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['face_emotyion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Face Emotyion Val'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['face_emotyion_val']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Memo'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['memo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Img1'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['img1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Img File'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['img_file']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($emotion['Emotion']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Emotion'), array('action' => 'edit', $emotion['Emotion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Emotion'), array('action' => 'delete', $emotion['Emotion']['id']), array(), __('Are you sure you want to delete # %s?', $emotion['Emotion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Emotions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emotion'), array('action' => 'add')); ?> </li>
	</ul>
</div>
