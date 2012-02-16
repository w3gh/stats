<?php
$this->breadcrumbs=array(
	'Bans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bans', 'url'=>array('index')),
	array('label'=>'Create Bans', 'url'=>array('create')),
	array('label'=>'View Bans', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bans', 'url'=>array('admin')),
);
?>

<h1>Update Bans <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>