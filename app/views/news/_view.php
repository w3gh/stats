<div class="article hero-unit">
	
	<h2><?=CHtml::encode($data->title);?></h2>

	<div class="meta"><?=date(param('dateFormat'),strtotime($data->created));?></div>
	<div class="content">
		<?=CHtml::encode($data->content);?>
	</div>

</div>