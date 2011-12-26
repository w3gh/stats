<?php
$this->breadcrumbs=array(
    __('app','Login'),
);
$this->pageTitle=__('app','Login');
?>

<?php if($model->hasErrors()): ?>
	<div class="alert-message error">
        <a href="#" class="close">×</a>
        <p><?= CHtml::errorSummary($model,''); ?></p>
    </div>
<?php endif; ?>

<div class="form form-unit">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<fieldset>
		<legend>Login</legend>

<!--		<p class="note">Fields with <span class="required">*</span> are required.</p>-->

		<div class="clearfix <?= ($model->getError('username')) ? 'error':''?>">
			<?php echo $form->labelEx($model,'username'); ?>
			<div class="input">
					<?php echo $form->textField($model,'username'); ?>
			</div>
			<?php //echo $form->error($model,'username'); ?>
		</div>

		<div class="clearfix <?= ($model->getError('password')) ? 'error':''?>">
			<?php echo $form->labelEx($model,'password'); ?>
			<div class="input">
					<?php echo $form->passwordField($model,'password'); ?>
				<p class="help-inline">	Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.</p>
			</div>

			<?php //echo $form->error($model,'password'); ?>

		</div>

		<div class="clearfix <?= ($model->getError('rememberMe')) ? 'error':''?>">
			<div class="input">
				<ul class="inputs-list">
					<li>
						<label>
							<?php echo $form->checkBox($model,'rememberMe'); ?>
							<span><?= $model->getAttributeLabel('rememberMe');?></span>
						</label>
					</li>
				</ul>
			</div>
		</div>

		<div class="actions">
			<?php echo CHtml::submitButton('Login',array('class'=>'btn primary')); ?>
		</div>
	</fieldset>
<?php $this->endWidget(); ?>
</div><!-- form -->