<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="grid_4">
		<div id="sidebar">
<com:zii.widgets.CMenu items={$this->dashboard_menu} htmlOptions={array('class'=>'links')} />
		</div><!-- sidebar -->
	</div>
	<div class="grid_12">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>