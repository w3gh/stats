<?php
$this->breadcrumbs=array(
	'Safelists'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Safelist', 'url'=>array('index')),
	array('label'=>'Create Safelist', 'url'=>array('create')),
	array('label'=>'Update Safelist', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Safelist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Safelist', 'url'=>array('admin')),
);
?>

<h1>View Safelist #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'server',
		'name',
		'voucher',
	),
)); ?>
