<?php
$this->breadcrumbs=array(
	'Safelists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Safelist', 'url'=>array('index')),
	array('label'=>'Manage Safelist', 'url'=>array('admin')),
);
?>

<h1>Create Safelist</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>