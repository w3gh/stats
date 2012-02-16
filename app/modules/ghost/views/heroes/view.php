<?php



$this->breadcrumbs=array(
	__('app','Heroes')=>array('index'),
	$description,
);

$this->pageTitle=$description.' '.__('app','Information');

$this->title=$description.' '.CHtml::tag('small',array(),__('app','Information'));

$this->menu=array(
	array('label'=>'List Heroes', 'url'=>array('index')),
	array('label'=>'Create Heroes', 'url'=>array('create')),
	array('label'=>'Update Heroes', 'url'=>array('update', 'id'=>$hid)),
	array('label'=>'Delete Heroes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$hid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Heroes', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_view',array('hero'=>$hero,'hid'=>$hid,'description'=>$description))?>

<?php $this->widget('HeroMostUsedItems',array('heroId'=>$hid))?>

<?php $this->widget('HeroGameHistory',array(
	                                     'heroId'=>$hid,
	                                     'heroName'=>$description,
                                      ))?>
