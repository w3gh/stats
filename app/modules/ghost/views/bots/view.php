<?php
$this->breadcrumbs=array(
	'Bots'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Bots', 'url'=>array('index')),
	array('label'=>'Create Bots', 'url'=>array('create')),
	array('label'=>'Update Bots', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bots', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bots', 'url'=>array('admin')),
);
?>

<h1>View Bots #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'botid',
		'name',
	),
)); ?>
