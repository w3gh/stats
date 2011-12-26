<div class="article">
	
	<h2><?=CHtml::link($data->title,array('view','id'=>$data->id));?></h2>

	<div class="meta"><?=date(param('dateFormat'),strtotime($data->created));?></div>
	<div class="content">
		<?=CHtml::encode($data->content);?>
	</div>

</div>