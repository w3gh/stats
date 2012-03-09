<?php
$this->breadcrumbs=array(
	__('app','News')=>array('index'),
    CHtml::encode($model->title),
);

if (app()->user->checkAccess('administrator'))
{
    $this->menu=array(
        array('label'=>'List News', 'url'=>array('index')),
        array('label'=>'Create News', 'url'=>array('create')),
        array('label'=>'Update News', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Delete News', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>'Manage News', 'url'=>array('admin')),
    );

}

$this->pageTitle=$this->title=CHtml::encode($model->title);

?>
<div class="hero-unit">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'content',
		'created',
	),
)); ?>

<h3>Comments</h3>

<?php $this->renderPartial('comment.views.comment.commentList', array(
	'model'=>$model
)); ?>
</div>
