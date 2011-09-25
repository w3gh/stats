<?php
$this->breadcrumbs=array(
	'Safelists'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Safelist', 'url'=>array('index')),
	array('label'=>'Create Safelist', 'url'=>array('create')),
	array('label'=>'View Safelist', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Safelist', 'url'=>array('admin')),
);
?>

<h1>Update Safelist <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>