<?php
/*
 * players index template file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://w3gh.ru
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

Yii::app()->clientScript->registerScript('players-search', "
$('#navigation div.search form').submit(function(){
	$.fn.yiiGridView.update('Players-list-grid', {
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
<div class="grid_4"><h4>Players</h4></div>
<div class="grid_4 playersearch">

<?php /**
$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
    <?php $this->widget('CAutoComplete',
          array(
             'model'=>$model,
             'name'=>'Players[name]',
             'url'=>array('/'.$this->getModule()->getId().'/'.$this->getId().'/autocompleteplayername'),
             'minChars'=>2,
             ));
    ?>
    <?php //echo CHtml::hiddenField('name'); ?>
		<?php //echo $form->textField($model,'name',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); */ ?>
</div>
<div class="clear"></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
  'id'=>'Players-list-grid',
	'dataProvider'=>$dataProvider,
  'cssFile'=>false,
   'pager'=>array(
       'cssFile'=>false,
   ),
   'columns'=>array(
       array(
           'header'=>'Player Name',
           'id'=>'playername',
           'headerHtmlOptions'=>array(),
           'type'=>'raw',
           'name'=>'name',
           'value'=>'CHtml::link(GHtml::playerStatus($data), array("player","name"=>$data->name, "server"=>$data->serverid));',
       ),
       array(
           'header'=>'Games',
           'id'=>'totalgames',
           'name'=>'totgames',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'Kills',
           'id'=>'herokills',
           'name'=>'kills',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'Deaths',
           'id'=>'herodeaths',
           'name'=>'deaths',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'Assists',
           'id'=>'herodeaths',
           'name'=>'assists',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'Creeps',
           'id'=>'creepkills',
           'name'=>'creepkills',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'Denies',
           'id'=>'creepdenies',
           'name'=>'creepdenies',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'Neutrals',
           'id'=>'neutralkills',
           'name'=>'neutralkills',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'Towers',
           'id'=>'towerkills',
           'name'=>'towerkills',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'Last Game',
           'id'=>'lastplayed',
           'name'=>'lastplayed',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'First Game',
           'id'=>'firstplayed',
           'name'=>'firstplayed',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'header'=>'Server',
           'id'=>'server',
           'name'=>'server',
           'type'=>'raw',
           'value'=>'CHtml::encode($data->servername);',
           'headerHtmlOptions'=>array(),
       ),
   ),
));
?>

<?php /* $this->widget('CLinkPager', array(
    'pages' => $pager,
)) */ ?>

