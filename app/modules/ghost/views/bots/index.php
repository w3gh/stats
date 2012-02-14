<?php
$this->breadcrumbs=array(
	'Bots',
);

$this->menu=array(
	array('label'=>'Create Bots', 'url'=>array('create')),
	array('label'=>'Manage Bots', 'url'=>array('admin')),
);
?>

<h1>Bots</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
