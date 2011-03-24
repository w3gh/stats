<?php /* source file: /home/jilizart/www/Yii/framework/gii/views/default/login.php */ ?>
<div class="form login">
<?php $form=$this->beginWidget('CActiveForm'); ?>
	<p>Please enter your password</p>

	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>

	<?php echo CHtml::submitButton('Enter'); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->
