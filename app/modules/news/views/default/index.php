<?php
$this->breadcrumbs=array(
	'News',
);

if (app()->user->checkAccess('administrator'))
{
    $this->menu=array(
    	array('label'=>'Create News', 'url'=>array('create')),
    	array('label'=>'Manage News', 'url'=>array('admin')),
    );
}

$this->pageTitle=$this->title=__('app','News');
?>
<div class="news-entry hero-unit">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'template'=>"{sorter}\n{items}\n{pager}",//{summary}\n
	'itemView'=>'_view',
)); ?>
</div>