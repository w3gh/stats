<?php

?>

<h1>View Bans #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'botid',
		'server',
		'name',
		'ip',
		'date',
		'gamename',
		'admin',
		'reason',
	),
)); ?>
