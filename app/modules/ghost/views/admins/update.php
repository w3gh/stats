<?php
$this->breadcrumbs=array(
	'Admins'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Admins', 'url'=>array('index')),
	array('label'=>'Create Admins', 'url'=>array('create')),
	array('label'=>'View Admins', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Admins', 'url'=>array('admin')),
);
?>

<h1>Update Admins <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>