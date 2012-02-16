<?php
$this->breadcrumbs=array(
	'Heroes'=>array('index'),
	$model->heroid=>array('view','id'=>$model->heroid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Heroes', 'url'=>array('index')),
	array('label'=>'Create Heroes', 'url'=>array('create')),
	array('label'=>'View Heroes', 'url'=>array('view', 'id'=>$model->heroid)),
	array('label'=>'Manage Heroes', 'url'=>array('admin')),
);
?>

<h1>Update Heroes <?php echo $model->heroid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>