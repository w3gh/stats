<?php
$this->breadcrumbs=array(
	'Bots'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bots', 'url'=>array('index')),
	array('label'=>'Manage Bots', 'url'=>array('admin')),
);
?>

<h1>Create Bots</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>