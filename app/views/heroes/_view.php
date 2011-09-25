<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('heroid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->heroid), array('view', 'id'=>$data->heroid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('original')); ?>:</b>
	<?php echo CHtml::encode($data->original); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:</b>
	<?php echo CHtml::encode($data->summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stats')); ?>:</b>
	<?php echo CHtml::encode($data->stats); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skills')); ?>:</b>
	<?php echo CHtml::encode($data->skills); ?>
	<br />


</div>