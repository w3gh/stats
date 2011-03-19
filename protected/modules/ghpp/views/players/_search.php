<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'botid'); ?>
		<?php echo $form->textField($model,'botid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gameid'); ?>
		<?php echo $form->textField($model,'gameid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'spoofed'); ?>
		<?php echo $form->textField($model,'spoofed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reserved'); ?>
		<?php echo $form->textField($model,'reserved'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'loadingtime'); ?>
		<?php echo $form->textField($model,'loadingtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'left'); ?>
		<?php echo $form->textField($model,'left'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leftreason'); ?>
		<?php echo $form->textField($model,'leftreason',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'team'); ?>
		<?php echo $form->textField($model,'team'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'colour'); ?>
		<?php echo $form->textField($model,'colour'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'spoofedrealm'); ?>
		<?php echo $form->textField($model,'spoofedrealm',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->