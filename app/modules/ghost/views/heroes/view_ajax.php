<?php
$totgames=        number_format($hero['totgames'],"0",".",",");
$wins=            number_format($hero['wins'],"0",".",",");
$losses=          number_format($hero['losses'],"0",".",",");
$winratio=        round($hero['winratio'],2);
$kills=           number_format(round($hero['kills'],2),"0",".",",");
$deaths=          round($hero['deaths'],2);
$assists=         number_format(round($hero['assists'],2),"0",".",",");
$kdratio=         round($hero['kdratio'],2);
$creepkills=      number_format(round($hero['creepkills'],2),"0",".",",");
$creepdenies=     number_format(round($hero['creepdenies'],2),"0",".",",");
$neutralkills=    number_format(round($hero['neutralkills'],2),"0",".",",");
$towerkills=      number_format(round($hero['towerkills'],2),"0",".",",");
$raxkills=        number_format(round($hero['raxkills'],2),"0",".",",");
$courierkills=    number_format(round($hero['courierkills'],2),"0",".",",");
$summary=         CHtml::encode($hero['summary']);
$stats=           CHtml::encode($hero['stats']);
$skills=          CHtml::encode($hero['skills']);

$summary=         CHtml::encode($hero["summary"]);
$stats=           $hero["stats"];
$skills=          $hero["skills"];

$stats = str_replace("Strength",
                     "<img style='vertical-align: middle;'
                     alt='".__('app','Strength')."' src='".$this->assetsUrl."/img/strength.gif'
                     border=0 />Strength",$stats);
$stats = str_replace("Agility",
                     "<img style='vertical-align: middle;'
                     alt='".__('app','Agility')."' src='".$this->assetsUrl."/img/agility.gif'
                     border=0 />Agility",$stats);
$stats = str_replace("Intelligence",
                     "<img style='vertical-align: middle;'
                     alt='".__('app','intelligence')."' src='".$this->assetsUrl."/img/intelligence.gif'
                     border=0 />Intelligence",$stats);

?>
<a href='<?=$this->createUrl('view', array('id' => $hid))?>'>
	<img
			style='vertical-align: middle;'
			width='24'
			height='24'
			alt=''
			src='<?=$this->assetsUrl?>/img/heroes/<?=$hid?>.gif'
			border="0"/>
</a>
<div class="small">
<div align='justify'><?=app()->format->html($summary)?></div>
<div class="clear"></div>
<?=app()->format->html($stats)?>
<div class="clear"></div>
<?=app()->format->html($skills)?>
</div>