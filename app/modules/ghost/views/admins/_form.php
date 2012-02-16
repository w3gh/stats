<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admins-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'botid'); ?>
		<?php echo $form->textField($model,'botid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'botid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'server'); ?>
		<?php echo $form->textField($model,'server',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'server'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->