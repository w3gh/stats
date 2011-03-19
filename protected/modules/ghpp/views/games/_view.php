<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('botid')); ?>:</b>
	<?php echo CHtml::encode($data->botid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('server')); ?>:</b>
	<?php echo CHtml::encode($data->server); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map')); ?>:</b>
	<?php echo CHtml::encode($data->map); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datetime')); ?>:</b>
	<?php echo CHtml::encode($data->datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gamename')); ?>:</b>
	<?php echo CHtml::encode($data->gamename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ownername')); ?>:</b>
	<?php echo CHtml::encode($data->ownername); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	<?php echo CHtml::encode($data->duration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gamestate')); ?>:</b>
	<?php echo CHtml::encode($data->gamestate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creatorname')); ?>:</b>
	<?php echo CHtml::encode($data->creatorname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creatorserver')); ?>:</b>
	<?php echo CHtml::encode($data->creatorserver); ?>
	<br />

	*/ ?>

</div>