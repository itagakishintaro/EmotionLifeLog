<div class="emotions index">
	<h2><?php echo __('Emotions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('record_date'); ?></th>
			<th><?php echo $this->Paginator->sort('my_emotion'); ?></th>
			<th><?php echo $this->Paginator->sort('my_emotion_val'); ?></th>
			<th><?php echo $this->Paginator->sort('analyzed_emotion'); ?></th>
			<th><?php echo $this->Paginator->sort('analyzed_emotion_val'); ?></th>
			<th><?php echo $this->Paginator->sort('face_emotyion'); ?></th>
			<th><?php echo $this->Paginator->sort('face_emotyion_val'); ?></th>
			<th><?php echo $this->Paginator->sort('memo'); ?></th>
			<th><?php echo $this->Paginator->sort('img1'); ?></th>
			<th><?php echo $this->Paginator->sort('img_file'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($emotions as $emotion): ?>
	<tr>
		<td><?php echo h($emotion['Emotion']['id']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['record_date']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['my_emotion']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['my_emotion_val']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['analyzed_emotion']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['analyzed_emotion_val']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['face_emotyion']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['face_emotyion_val']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['memo']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['img1']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['img_file']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['created']); ?>&nbsp;</td>
		<td><?php echo h($emotion['Emotion']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $emotion['Emotion']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $emotion['Emotion']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $emotion['Emotion']['id']), array(), __('Are you sure you want to delete # %s?', $emotion['Emotion']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Emotion'), array('action' => 'add')); ?></li>
	</ul>
</div>
