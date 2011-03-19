<?php
Yii::app()->clientScript->registerScript('bans-search', "
$('.playersearch form').submit(function(){
	$.fn.yiiGridView.update('Bans-list-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$serversMenu=array(
  array('label'=>Yii::t('ghppModule.players', 'All'), 'url'=>array('index')),
);
foreach($servers as $id=>$server)
{
  //array('label'=>Yii::t('menuTop', 'Home'), 'url'=>array('/post/index')),
  $serversMenu[]=array('label'=>$server->name, 'url'=>array('index', 'server'=>$server->id));
}

?>

<div class="grid_8">
  <com:zii.widgets.CMenu items={$serversMenu} htmlOptions={array('class'=>'links inline')} />
</div>
<div class="grid_2"><h4>Bans</h4></div>
<div class="grid_6 playersearch">
  <?php
  $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl('bans/index'),
    'method'=>'get',
  )); ?>

      <?php //echo $form->label($model,'name'); ?>
      <?php $this->widget('CAutoComplete',
            array(
               'model'=>$model,
               'name'=>'Bans[name]',
               'url'=>array('/ghpp/bans/autocompleteplayername'),
               'minChars'=>2,
               'cssFile'=>false,
               'htmlOptions'=>array('class'=>'form-autocomplete'),
               ));
      ?>

      <?php echo CHtml::submitButton('Search'); ?>

  <?php $this->endWidget(); ?>
</div>
<div class="clear"></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
  'id'=>'Bans-list-grid',
	'dataProvider'=>$dataProvider,
  'cssFile'=>false,
  'columns'=>array(
       array(
           'id'=>'playername',
           'header'=>Yii::t('ghppModule.bans' ,'Player Name'),
           'name'=>'name',
           'type'=>'raw',
           'value'=>'CHtml::link($data->name, array("players/player","name"=>$data->name, "server"=>$data->serverid));',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'id'=>'playerreason',
           'name'=>'reason',
           'header'=>Yii::t('ghppModule.bans' ,'Reason'),
           'headerHtmlOptions'=>array(),
       ),
       array(
           'id'=>'gamename',
           'name'=>'gamename',
           'header'=>Yii::t('ghppModule.bans' ,'Game Name'),
           'headerHtmlOptions'=>array(),
       ),
       array(
           'id'=>'datetime',
           'name'=>'datetime',
           'header'=>Yii::t('ghppModule.bans' ,'Date'),
           'headerHtmlOptions'=>array(),
           'type'=>'raw',
           'value'=>'$data->date'
       ),
       array(
           'id'=>'admin',
           'header'=>Yii::t('ghppModule.bans' ,'Banned by'),
           'name'=>'admin',
           'type'=>'raw',
           'value'=>'$data->admin',
           'headerHtmlOptions'=>array(),
       ),
      array(
            'id'=>'server',
            'name'=>'servername',
            'header'=>Yii::t('ghppModule.bans' ,'Server'),
            'headerHtmlOptions'=>array(),
      ),
      array(
            'id'=>'bot',
            'name'=>'boname',
            'header'=>Yii::t('ghppModule.bans' ,'Bot'),
            'headerHtmlOptions'=>array(),
      ),
   ),
	'pager'=>array(
      'cssFile'=>false,
  ),
)); ?>