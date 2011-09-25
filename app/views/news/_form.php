<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'news_title'); ?>
		<?php echo $form->textField($model,'news_title',array('size'=>60,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'news_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_content'); ?>
		<?php echo $form->textArea($model,'news_content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'news_content'); ?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'news_date'); ?>
		<?php echo $form->textField($model,'news_date'); ?>
		<?php echo $form->error($model,'news_date'); */?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->