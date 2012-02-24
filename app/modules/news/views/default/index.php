<?php
$this->breadcrumbs=array(
	__('news','News'),
);

if (app()->user->checkAccess('administrator'))
{
    $this->menu=array(
    	array('label'=>'Create News', 'url'=>array('admin/create')),
    	array('label'=>'Manage News', 'url'=>array('admin/index')),
    );
}

$this->pageTitle=$this->title=__('app','News');
?>
<div class="news-list">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'template'=>"{sorter}\n{items}\n{pager}",//{summary}\n
	'itemView'=>'_view',
)); ?>
</div>