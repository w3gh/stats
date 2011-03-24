<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'heroes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'original'); ?>
		<?php echo $form->textField($model,'original',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'original'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textField($model,'summary',array('size'=>60,'maxlength'=>900)); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stats'); ?>
		<?php echo $form->textField($model,'stats',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'stats'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'skills'); ?>
		<?php echo $form->textField($model,'skills',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'skills'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->