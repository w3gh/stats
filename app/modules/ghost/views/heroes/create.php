<?php
$this->breadcrumbs=array(
	'Heroes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Heroes', 'url'=>array('index')),
	array('label'=>'Manage Heroes', 'url'=>array('admin')),
);
?>

<h1>Create Heroes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>