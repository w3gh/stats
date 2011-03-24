<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admins-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row form-item">
		<?php echo $form->labelEx($model,'botid'); ?>
		<?php echo $form->textField($model,'botid'); ?>
		<?php echo $form->error($model,'botid'); ?>
	</div>

	<div class="row form-item">
		<?php echo $form->labelEx($model,'name'); ?>
    <?php $this->widget('CAutoComplete',
          array(
             'model'=>$model,
             'name'=>'Admins[name]',
             'url'=>array('/'.$this->getModule()->getId().'/players/autocompleteplayername'),
             'minChars'=>2,
             'cssFile'=>false,
             'htmlOptions'=>array('class'=>'form-autocomplete'),
             ));
    ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row form-item">
		<?php echo $form->labelEx($model,'server'); ?>
		<?php echo $form->dropDownList($model, 'server', Servers::model()->list); ?>
		<?php echo $form->error($model,'server'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'form-submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->