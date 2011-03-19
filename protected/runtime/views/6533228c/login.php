<?php /* source file: /home/jilizart/www/Yii/html/protected/views/site/login.php */ ?>

<div class="grid_16">
  <h4>Login</h4>
  <p>Please fill out the following form with your login credentials:</p>
</div>
<div class="clear"></div>
<div class="form grid_6 prefix_5 suffix_5">
<?php echo CHtml::beginForm(); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row form-item">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username', array('class'=>'form-text')); ?>
	</div>

	<div class="row form-item">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password', array('class'=>'form-text', 'title'=>'hello world')); ?>
		<p class="hint">
			Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
		</p>
	</div>

	<div class="row form-item">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabel($model,'rememberMe'); ?>
	</div>
  <div class="buttons">
    <div class="row submit">
      <?php echo CHtml::submitButton('Login', array('class'=>'form-submit')); ?>
    </div>
  </div>
<?php echo CHtml::endForm(); ?>
</div><!-- form -->

<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>