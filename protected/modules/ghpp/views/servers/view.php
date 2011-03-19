<?php

?>

<h1>View Servers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'server',
		'name',
		'port',
	),
)); ?>
