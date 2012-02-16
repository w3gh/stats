<?php
$this->breadcrumbs=array(
	'Servers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Servers', 'url'=>array('index')),
	array('label'=>'Manage Servers', 'url'=>array('admin')),
);
?>

<h1>Create Servers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>