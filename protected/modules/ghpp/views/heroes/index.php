<?php
$this->breadcrumbs->mergeWith(array(
	'Heroes',
));

$this->tabs->copyFrom(array(
	array('label'=>'Create Heroes', 'url'=>array('create')),
	array('label'=>'Manage Heroes', 'url'=>array('admin')),
));
?>

<h1>Heroes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
  'pager'=>array(
    'cssFile'=>false,
  ),
)); ?>
