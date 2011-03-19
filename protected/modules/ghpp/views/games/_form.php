<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'games-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'botid'); ?>
		<?php echo $form->textField($model,'botid'); ?>
		<?php echo $form->error($model,'botid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'server'); ?>
		<?php echo $form->textField($model,'server',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'server'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'map'); ?>
		<?php echo $form->textField($model,'map',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'map'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datetime'); ?>
		<?php echo $form->textField($model,'datetime'); ?>
		<?php echo $form->error($model,'datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gamename'); ?>
		<?php echo $form->textField($model,'gamename',array('size'=>31,'maxlength'=>31)); ?>
		<?php echo $form->error($model,'gamename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ownername'); ?>
		<?php echo $form->textField($model,'ownername',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'ownername'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->textField($model,'duration'); ?>
		<?php echo $form->error($model,'duration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gamestate'); ?>
		<?php echo $form->textField($model,'gamestate'); ?>
		<?php echo $form->error($model,'gamestate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creatorname'); ?>
		<?php echo $form->textField($model,'creatorname',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'creatorname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creatorserver'); ?>
		<?php echo $form->textField($model,'creatorserver',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'creatorserver'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->