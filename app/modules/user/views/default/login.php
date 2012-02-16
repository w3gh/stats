<?php
$this->breadcrumbs=array(
    __('app','Login'),
);
$this->pageTitle=__('app','Login');
?>

<?php if($model->hasErrors()): ?>
	<div class="alert-message error">
        <a href="#" class="close">×</a>
        <p><?= CHtml::errorSummary($model,'')?></p>
    </div>
<?php endif?>

<div class="form form-unit">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
    'htmlOptions'=>array(
        'class'=>'form-horizontal'
    ),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
))?>
	<fieldset>
		<legend>Login</legend>

		<div class="control-group <?= ($model->getError('username')) ? 'error':''?>">
			<?=$form->labelEx($model,'username',array('class'=>'control-label'))?>
			<div class="controls">
					<?=$form->textField($model,'username')?>
			</div>
			<?php //echo $form->error($model,'username')?>
		</div>

		<div class="control-group <?= ($model->getError('password')) ? 'error':''?>">
			<?=$form->labelEx($model,'password')?>
			<div class="controls">
					<?=$form->passwordField($model,'password')?>
				<p class="help-inline">	Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.</p>
			</div>

			<?php //echo $form->error($model,'password')?>

		</div>

		<div class="control-group <?= ($model->getError('rememberMe')) ? 'error':''?>">
            <div class="controls">

                <label class="checkbox">
                    <?=$form->checkBox($model,'rememberMe')?>
                    <span><?= $model->getAttributeLabel('rememberMe');?></span>
                </label>

            </div>
		</div>

		<div class="actions">
			<?=CHtml::submitButton(__('app','Login'),array('class'=>'btn btn-large btn-primary'))?>
            <?=CHtml::link(__('app','Create Account'),array('/user/default/register'),array('class'=>'btn btn-large'))?>
		</div>
	</fieldset>
<?php $this->endWidget()?>
</div><!-- form -->