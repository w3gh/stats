<?php
$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->news_id=>array('view','id'=>$model->news_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'View News', 'url'=>array('view', 'id'=>$model->news_id)),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<h1>Update News <?php echo $model->news_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>