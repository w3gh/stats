<?php
$this->breadcrumbs=array(
	'Bans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bans', 'url'=>array('index')),
	array('label'=>'Manage Bans', 'url'=>array('admin')),
);
?>

<h1>Create Bans</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>