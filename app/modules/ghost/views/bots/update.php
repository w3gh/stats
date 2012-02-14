<?php
$this->breadcrumbs=array(
	'Bots'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bots', 'url'=>array('index')),
	array('label'=>'Create Bots', 'url'=>array('create')),
	array('label'=>'View Bots', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bots', 'url'=>array('admin')),
);
?>

<h1>Update Bots <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>