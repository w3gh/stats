<?php $this->beginContent('//layouts/main'); ?>

	<div id="content" class="row-fluid">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('Breadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>

        <div class="ghost-page">
            <?= $content; ?>
        </div>
	</div><!-- content -->

<?php $this->endContent(); ?>