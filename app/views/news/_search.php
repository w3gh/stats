<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="clearfix">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>90)); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="clearfix buttons">
		<?php echo CHtml::submitButton(__('Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->