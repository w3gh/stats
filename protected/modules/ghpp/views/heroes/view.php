<?php
$this->breadcrumbs->mergeWith(array(
	'Heroes'=>array('index'),
	$model->description,
));

$this->tabs->copyFrom(array(
	array('label'=>'List Heroes', 'url'=>array('index')),
	array('label'=>'Create Heroes', 'url'=>array('create')),
	array('label'=>'Update Heroes', 'url'=>array('update', 'id'=>$model->heroid)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->heroid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Heroes', 'url'=>array('admin')),
));
?>

<h1>View Heroes #<?php echo $model->heroid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'heroid',
		'original',
		'description',
		'summary',
		'stats',
		'skills',
	),
)); ?>
