<?php /* source file: /home/jilizart/www/Yii/html/protected/views/site/sender.php */ ?>
<?php
$this->pageTitle='Send Us';
$this->breadcrumbs->mergeWith(array('Send'));
?>

<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('sender')): ?>
<div class="success">
  <?php echo Yii::app()->user->getFlash('sender'); ?>
</div>
<?php else: ?>

<div class="form">

<?php echo CHtml::beginForm(); ?>

  <p class="note">Fields with <span class="required">*</span> are required.</p>

  <?php echo CHtml::errorSummary($model); ?>

  <div class="row">
    <?php echo CHtml::activeLabelEx($model,'server'); ?>
    <?php echo CHtml::activeTextField($model,'server'); ?>
  </div>

  <div class="row">
    <?php echo CHtml::activeLabelEx($model,'port'); ?>
    <?php echo CHtml::activeTextField($model,'port'); ?>
  </div>

  <div class="row">
    <?php echo CHtml::activeLabelEx($model,'message'); ?>
    <?php echo CHtml::activeTextField($model,'message',array('size'=>60,'maxlength'=>256)); ?>
  </div>


  <div class="row submit">
    <?php echo CHtml::submitButton('Send'); ?>
  </div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->

<?php endif; ?>