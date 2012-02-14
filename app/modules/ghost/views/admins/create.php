<?php
$this->breadcrumbs=array(
	'Admins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Admins', 'url'=>array('index')),
	array('label'=>'Manage Admins', 'url'=>array('admin')),
);
?>

<h1>Create Admins</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>