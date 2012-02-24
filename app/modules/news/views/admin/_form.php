
<?php if($model->hasErrors()): ?>
	<div class="alert-message error">
        <a href="#" class="close">×</a>
        <p><?= CHtml::errorSummary($model,''); ?></p>
    </div>
<?php endif; ?>
<div class="form form-unit">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'news-form',
        'enableAjaxValidation'=>false,
    )); ?>
        <fieldset>
            <legend><?= $model->isNewRecord ? 'Create' : 'Save' ?> News</legend>

            <div class="clearfix  <?= ($model->getError('title')) ? 'error':''?>">
                <?php echo $form->labelEx($model,'title'); ?>
                <div class="input">
                    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>90, 'class'=>'xxlarge')); ?>
                </div>
            </div>

            <div class="clearfix  <?= ($model->getError('content')) ? 'error':''?>">
                <?php echo $form->labelEx($model,'content'); ?>
                <div class="input">
                    <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>100, 'class'=>'xxlarge')); ?>
                </div>
            </div>

            <div class="clearfix">
                <?php /*echo $form->labelEx($model,'news_date'); ?>
                <?php echo $form->textField($model,'news_date'); ?>
                <?php echo $form->error($model,'news_date'); */?>
            </div>

            <div class="actions">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn primary')); ?>
            </div>

        </fieldset>
    <?php $this->endWidget(); ?>
</div>