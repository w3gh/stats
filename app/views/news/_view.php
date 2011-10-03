<div class="article hero-unit">
<?/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('news_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->news_id), array('view', 'id'=>$data->news_id)); ?>
	<br />
*/?>
	
	<h2><?=CHtml::encode($data->news_title);?></h2>

	<div class="meta"><?=date(param('dateFormat'),strtotime($data->news_created));?></div>
	<div class="content">
		<?=CHtml::encode($data->news_content);?>
	</div>

<?/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('news_created')); ?>:</b>
	<?php echo CHtml::encode($data->news_created); ?>
	<br />
*/?>

</div>