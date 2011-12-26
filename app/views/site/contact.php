<?php
$this->pageTitle=app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<div class="hero-unit">
<h2>Contact Us</h2>

<?php if(app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="clearfix  <?= ($model->getError('name')) ? 'error':''?>">
		<?php echo $form->labelEx($model,'name'); ?>
        <div class="input">
            <?php echo $form->textField($model,'name',array('class'=>'xxlarge')); ?>
        </div>
	</div>

	<div class="clearfix  <?= ($model->getError('email')) ? 'error':''?>">
		<?php echo $form->labelEx($model,'email'); ?>
        <div class="input">
            <?php echo $form->textField($model,'email',array('class'=>'xxlarge')); ?>
        </div>
	</div>

	<div class="clearfix  <?= ($model->getError('subject')) ? 'error':''?>">
		<?php echo $form->labelEx($model,'subject'); ?>
        <div class="input">
            <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128,'class'=>'xxlarge')); ?>
        </div>
	</div>

	<div class="clearfix  <?= ($model->getError('body')) ? 'error':''?>">
		<?php echo $form->labelEx($model,'body'); ?>
        <div class="input">
            <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'xxlarge')); ?>
        </div>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="clearfix  <?= ($model->getError('verifyCode')) ? 'error':''?>">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div class="input">
            <?php $this->widget('CCaptcha'); ?>
            <?php echo $form->textField($model,'verifyCode'); ?>
            <span class="help-block">Please enter the letters as they are shown in the image above.
          		<br/>Letters are not case-sensitive.</span>
		</div>
	</div>
	<?php endif; ?>

	<div class="actions">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
</div>