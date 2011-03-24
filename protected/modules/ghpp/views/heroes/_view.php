<div class="view">
<?php $replay = new DotaReplay(''); $parser = $replay->getParser(); ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('heroid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->heroid), array('view', 'id'=>$data->heroid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('original')); ?>:</b>
	<?php echo CHtml::encode($data->original); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo $data->description; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:</b>
	<?php echo $data->summary; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stats')); ?>:</b>
	<?php echo $data->stats; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skills')); ?>:</b>
	<?php echo $data->skills; ?>
	<br />


</div>