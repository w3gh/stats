<?php
$this->breadcrumbs=array(
	'Safelists',
);

$this->menu=array(
	array('label'=>'Create Safelist', 'url'=>array('create')),
	array('label'=>'Manage Safelist', 'url'=>array('admin')),
);
?>

<h1>Safelists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
