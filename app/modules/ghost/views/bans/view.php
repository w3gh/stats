<?php
$this->breadcrumbs=array(
	'Bans'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Bans', 'url'=>array('index')),
	array('label'=>'Create Bans', 'url'=>array('create')),
	array('label'=>'Update Bans', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bans', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bans', 'url'=>array('admin')),
);
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
