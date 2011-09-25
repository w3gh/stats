<div class="hero-stat">
	<div class="hero-stat-name"><?=__('app','Played')?></div>
	<div class="hero-stat-icon"><?=CHtml::link($heroimg,array('heroes/view','id'=>$hero))?></div>
	<div class="hero-stat-desc"><?=__('app',':count Times',array(':count'=>$count))?> <br> (<?=$time?>)</div>
</div>