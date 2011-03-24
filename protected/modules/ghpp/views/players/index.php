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

?>

<div class="grid_8">
  <com:ServersMenu htmlOptions={array('class'=>'links inline')} />
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
<?php $this->renderPartial('_grid',array('dataProvider'=>$dataProvider)); ?>

