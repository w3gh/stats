<?php $this->beginContent('//layouts/main'); ?>


	<?php /*
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();*/
	?>
	<!-- sidebar -->

	<div id="content" class="row-fluid">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('Breadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>

			<?= $content; ?>
	</div><!-- content -->

<?php $this->endContent(); ?>