<?php
$this->breadcrumbs=array(
	'Servers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Servers', 'url'=>array('index')),
	array('label'=>'Create Servers', 'url'=>array('create')),
	array('label'=>'View Servers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Servers', 'url'=>array('admin')),
);
?>

<h1>Update Servers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>