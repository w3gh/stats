<?php /* source file: /home/jilizart/www/Yii/html/protected/modules/ghpp/views/players/view.php */ ?>
<?php
$serversmenu=$servernames=array();

$this->pageTitle=$model->name;

foreach($servers as $id =>$s)
  $servernames[$s->serverid] = $s->servername;

foreach($servers as $id=>$s)
  $serversmenu[]=array('label'=>$s->servername, 'url'=>array('player', 'name'=>$model->name,'server'=>$s->serverid));

$this->breadcrumbs->mergeWith(array(
  Yii::t('ghppModule.players' ,'Players')=>array('index'),
  $servernames[$server]=>array('index', 'server'=>$server),
  $model->name,
));

$this->tabs->copyFrom(array(
  array('label'=>'List Players', 'url'=>array('index')),
  array('label'=>'Heroes', 'url'=>array('players/heroes','name'=>$name, 'server'=>$server)),
  array('label'=>'History', 'url'=>array('players/games','name'=>$name,'server'=>$server)),
  array('label'=>'Items', 'url'=>array('index')),
  array('label'=>'Achiv\'s', 'url'=>array('index')),
));

?>

<div class="grid_6"><?php /* line 28 */ $this->widget('zii.widgets.CMenu', array('items'=>$serversmenu, 'htmlOptions'=>array('class'=>'links inline'))); ?></div>
<div class="grid_10"><h4>View Player <?php echo $model->name; ?></h4></div>
<div class="clear"></div>
<div class="grid_4">
<div style="float:left; width:50%;">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'kills',
		'deaths',
		'assists',
	),
)); ?>
</div>
<div style="float:left; width:50%;">
<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'creepkills',
		'creepdenies',
		'neutralkills',
	),
));
?>
</div>
</div>