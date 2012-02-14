<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'itemid'); ?>
		<?php echo $form->textField($model,'itemid',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'itemid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shortname'); ?>
		<?php echo $form->textField($model,'shortname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'shortname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_info'); ?>
		<?php echo $form->textArea($model,'item_info',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'item_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icon'); ?>
		<?php echo $form->textField($model,'icon',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'icon'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->