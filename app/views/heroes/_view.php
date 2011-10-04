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

<table class="list">
		<tbody>
			<tr>
				<td width='68%' valign='top'>
					<div class="clear"></div>

					<a href='<?=$this->createUrl('view', array('id' => $hid))?>'>
						<img
								style='vertical-align: middle;'
								width='64'
								height='64'
								alt=''
								src='<?=$this->assetsUrl?>/img/heroes/<?=$hid?>.gif'
								border="0"/>
					</a>

					<div align='justify'><?=app()->format->html($summary)?></div>
					<div class="clear"></div>
					<?=app()->format->html($stats)?>
					<div class="clear"></div>
					<?=app()->format->html($skills)?>
				</td>

				<td valign='top'>

					<table class="list zebra-striped">
						<tbody>
							<tr>
								<td width='60'><b><?=__('app', 'Wins')?></b></td>
								<td><?=$wins?></td>
								<td width='60'><b><?=__('app', 'Games')?></b></td>
								<td><?=$totgames?></td>
							</tr>
							<tr>
								<td width='60'><b><?=__('app', 'Losses')?></b></td>
								<td><?=$losses?></td>
								<td width='60'><b><?=__('app', 'W\L')?></b></td>
								<td><?=$winratio?></td>
							</tr>

							<tr>
								<td width='60'><b><?=__('app', 'Kills')?></b></td>
								<td><?=$kills?></td>
								<td width='60'><b><?=__('app', 'Assists')?></b></td>
								<td><?=$assists?></td>
							</tr>

							<tr>
								<td width='60'><b><?=__('app', 'Deaths')?></b></td>
								<td><?=$deaths?></td>
								<td width='60'><b><?=__('app', 'K\D')?></b></td>
								<td><?=$kdratio?></td>
							</tr>

							<tr>
								<td width='60'><b><?=__('app', 'Creeps')?></b></td>
								<td><?=$creepkills?></td>
								<td width='60'><b><?=__('app', 'Neutrals')?></b></td>
								<td><?=$neutralkills?></td>
							</tr>

							<tr>
								<td width='60'><b><?=__('app', 'Denies')?></td>
								<td><?=$creepdenies?></td>
								<td width='60'><b><?=__('app', 'Towers')?></td>
								<td><?=$towerkills?></td>
							</tr>

							<tr>
								<td width='60'><b><?=__('app', 'Rax')?></td>
								<td><?=$raxkills?></td>
								<td width='60'><b><?=__('app', 'Couriers')?></td>
								<td><?=$courierkills?></td>
							</tr>
						</tbody>
					</table>

				</td>
			</tr>
		</tbody>
</table>