<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
))?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	    <?=$form->errorSummary($model)?>

		<?=$form->labelEx($model,'username')?>
		<?=$form->textField($model,'username',array('size'=>60,'maxlength'=>255))?>
		<?=$form->error($model,'username')?>

		<?=$form->labelEx($model,'email')?>
		<?=$form->textField($model,'email',array('size'=>60,'maxlength'=>255))?>
		<?=$form->error($model,'email')?>

		<?=$form->labelEx($model,'password')?>
		<?=$form->passwordField($model,'password',array('size'=>60,'maxlength'=>255))?>
		<?=$form->error($model,'password')?>

		<?=$form->labelEx($model,'server')?>
		<?=$form->textField($model,'server',array('size'=>60,'maxlength'=>100))?>


	<div class="">
		<?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save')?>
	</div>

<?php $this->endWidget()?>

</div><!-- form -->