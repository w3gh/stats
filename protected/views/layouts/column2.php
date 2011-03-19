<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
	<div class="grid_12">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="grid_4">
		<div id="sidebar">
			<?php $this->widget('TagCloud', array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			)); ?>

			<?php $this->widget('RecentComments', array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			)); ?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>