<?php
$this->breadcrumbs=array(
	'News',
);

$this->menu=array(
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);

$this->pageTitle=$this->title=__('app','News');
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'template'=>"{sorter}\n{items}\n{pager}",//{summary}\n
	'itemView'=>'_view',
)); ?>
