<div class="article">
	
	<h2><?=CHtml::link($data->title,array('view','id'=>$data->id));?></h2>

	<div class="meta">
        <span class="date"><i class="icon-time"></i> <?=date(param('dateFormat'),strtotime($data->created));?></span>

    </div>
	<div class="content">
		<?=CHtml::encode($data->content);?>
	</div>

</div>