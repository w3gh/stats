
<h1>View Admins #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'botid',
		'name',
		'server',
	),
)); ?>
