<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->name=>array('view','id'=>$model->itemid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
	array('label'=>'View Items', 'url'=>array('view', 'id'=>$model->itemid)),
	array('label'=>'Manage Items', 'url'=>array('admin')),
);
?>

<h1>Update Items <?php echo $model->itemid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>