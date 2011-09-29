<?php $this->beginContent('//layouts/main'); ?>

	<div id="content">

		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('Breadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>
		
		<?php echo $content; ?>
	</div><!-- content -->

<?php $this->endContent(); ?>