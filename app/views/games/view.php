<?php

$dateFormat = param('dateFormat');

$creatorName =  $gameInfo['creatorname'];
$duration =     Util::secondsToTime($gameInfo['duration']);
$gameTime =     date($dateFormat, strtotime($gameInfo['datetime']));
$gmtime =       $gameInfo['datetime'];
$replayDate =   $gameInfo['datetime'];
$gameName =     $gameInfo['gamename'];
$win =          $gameInfo['winner'];

$scourge =        1;
$sentinel =       1;
$sentinelKills =  0;
$scourgeKills =   0;
$myScore =        0;
$bestScore =      0;
$bestPlayer =     "";

$this->breadcrumbs = array(
	'Games'=>array('index'),
	$gameName
);

/**
 * @FIXME Country Flags will be released as widget
 * @FIXME User points mod will be released as widget
 * @FIXME Replay Link Will be released as widget
 * @FIXME Replay Chat will be released as widget
 */

?>
<table>

	<tr>
		<th><?=$gameName?></th>
		<th></th>
		<th></th>
		<th><a href="#">DownloadReplay</a></th>
	</tr>

	<tr>
		<td><?=__('app', 'Game')?>: <b><?= $gameName; ?></b></td>
		<td><?=__('app', 'Date')?>: <b><?= $gmtime; ?></b></td>
		<td><?=__('app', 'Creator')?>: <b><?= (!empty($creatorName)) ? $creatorName:__('app','Autohosted'); ?></b></td>
		<td><?=__('app', 'Duration')?>: <b><?= $duration; ?></b></td>
	</tr>
	
</table>

<table>
<thead>
	<tr>
		<th class='padLeft' width='150'>
			<div align='center'><?=__('app', 'Player')?></div>
		</th>
		<th width='40'>
			<div align='center'><?=__('app', 'Hero')?></div>
		</th>
		<th width='50'>
			<div align='center'><?=__('app', 'Kills')?></div>
		</th>
		<th width='50'>
			<div align='center'><?=__('app', 'Deaths')?></div>
		</th>
		<th width='60'>
			<div align='center'><?=__('app', 'Assists')?></div>
		</th>
		<th width='60'>
			<div align='center'><?=__('app', 'Creeps')?></div>
		</th>
		<th width='60'>
			<div align='center'><?=__('app', 'Denies')?></div>
		</th>
		<th width='60'>
			<div align='center'><?=__('app', 'Neutrals')?></div>
		</th>
		<th width='60'>
			<div align='center'><?=__('app', 'Towers')?></div>
		</th>
		<th width='60'>
			<div align='center'><?=__('app', 'Gold')?></div>
		</th>
		<th width='220'>
			<div align='center'><?=__('app', 'Items')?></div>
		</th>
		<th width='60'>
			<div align='left'><?=__('app', 'Left at')?></div>
		</th>
		<th width='100'><?=__('app', 'Reason')?></th>
	</tr>
</thead>
<?php

foreach ($gameStats as $player):
	
	$player = new ArrayObject($player);
	
	$kills =        $player['kills'];//$player["kills"];
	$deaths =       $player['deaths'];
	$assists =      $player["assists"];
	$creepKills =   $player["creepkills"];
	$creepDenies =  $player["creepdenies"];
	$neutralKills = $player["neutralkills"];
	$towerKills =   $player["towerkills"];
	$raxkills =     $player["raxkills"];
	$courierkills = $player["courierkills"];

	$gold =         $player["gold"];

	$left =         Util::secondsToTime($player["left"]);
	$leftReason =   $player["leftreason"];
	$hero =         strtoupper($player["hero"]);
	$heroName =     $player["description"];
	$server =       $player["server"];
	$name=          trim($player["name"]);
	$nameId=        strtolower(trim($player["name"]));
	$name3=         trim($player["name"]);
	$newColour=     $player["newcolour"];
	$gameId=        $player["gameid"];
	$banName=       $player["banname"];
	$country = '';
	$points = '';

	$items = array();

	for ($i = 1; $i < 6; ++$i)
	{

		$iconPath = $this->assetsUrl . '/img/items/';

		$items[$i]['img'] = $iconPath . $player["itemicon{$i}"];

		if ($player["itemicon{$i}"] == "")
			$items[$i]['img'] = $iconPath . "empty.gif";

//		if (!file_exists($items[$i]['img']))
//			$items[$i]['img'] = $iconPath . "missing.gif";

		$items[$i]['id'] = $player["item{$i}"];
		$items[$i]['icon'] = $player["itemicon{$i}"];
	}


	if ($hero != "") {
		$hero = CHtml::link(
			CHtml::image($this->assetsUrl.'/img/heroes/'.$hero.'.gif','',array('width'=>28)),
			array('heroes/view','id'=>$hero)
		);
	}
	else
	{
		$hero = CHtml::image($this->assetsUrl.'/img/heroes/blank.gif','',array('width'=>28));
	}

	if (empty($nameId)) {
		$gold = 0;
		$points = 0;
		$hero = "";
		$kills = 0;
		$deaths = 0;
		$assists = 0;
		$creepKills = 0;
		$creepDenies = 0;
		$neutralKills = 0;
		$towerKills = 0;
		$left = "";
		$leftReason = "";
		$server = "";
		$items = array();
	}

	//Bold high results
	if ($kills >= 10) {
		$kills = "<b>{$kills}</b>";
	}
	if ($deaths >= 10) {
		$deaths = "<b>{$deaths}</b>";
	}
	if ($assists >= 10) {
		$assists = "<b>{$assists}</b>";
	}
	if ($creepKills >= 60) {
		$creepKills = "<b>{$creepKills}</b>";
	}
	if ($creepDenies >= 10) {
		$creepDenies = "<b>{$creepDenies}</b>";
	}
	if ($neutralKills >= 30) {
		$neutralKills = "<b>{$neutralKills}</b>";
	}
	if ($towerKills >= 2) {
		$towerKills = "<b>{$towerKills}</b>";
	}
	if ($gold >= 2500) {
		$gold = "<b>$gold</b>";
	}

	$myScore = ($kills - $deaths + $assists * 0.5) + ($towerKills * 0.3 + $raxkills * 0.3);
	if ($myScore > $bestScore AND $kills > 0) {
		$bestPlayer = $name;
		$bestScore = ($kills - $deaths + $assists * 0.5) + ($towerKills * 0.3 + $raxkills * 0.3);
	}

	$playerHtmlOptions=array();
	if (trim(strtolower($player['banname'])) == strtolower($player['name'])) {
		$playerHtmlOptions['style']='color:#BD0000';
	}

	if (trim(strtolower($player['adminname'])) == strtolower($player['name'])) {
		$playerHtmlOptions['style']='color:#0031bd';
	}

	//Trim down the leftreason
	$leftReason = str_ireplace("has", "", $leftReason);
	$leftReason = str_ireplace("was", "", $leftReason);
	$leftReason = ucfirst(trim($leftReason));
	$substring =  strchr($leftReason, "(");
	$leftReason = str_replace($substring, "", $leftReason);

	if ($win == 0) {
		$sentinelResult = __('app','Loser');
		$scourgeResult = __('app','Loser');
	}
	if ($win == 1) {
		$sentinelResult = __('app','Winner');
		$scourgeResult = __('app','Loser');
	}
	if ($win == 2) {
		$sentinelResult = __('app','Loser');
		$scourgeResult = __('app','Winner');
	}

	if ($newColour <= 5) { $sentinelKills += $kills; }

	if ($newColour > 5) { $scourgeKills += $kills; }

	if ($sentinel == 1 AND $newColour <= 5) {
		$sentinel = 0;
		?>
	<tr class='sentinelRow'>
		<td colspan='6'></td>
		<td><span class='sentinelCol'><?=__('app', 'Sentinel')?></span></td>
		<td><span class='sentinelCol'><?=$sentinelResult?></span></td>
		<td colspan='5'></td>
	</tr>
<?php

	}

	if ($scourge == 1 AND $newColour > 5)
	{
		$scourge = 0;
?>
		<tr class='scourgeRow'>
			<td colspan='6'></td>
			<td><span class='scourgeCol'><?=__('app', 'Scourge')?></span></td>
			<td><span class='scourgeCol'><?=$scourgeResult?></span></td>
			<td colspan='5'></td>
		</tr>
<?php
	}

	if (!empty($nameId) || param('showAllSlotsInGame')):
?>
	<tr>
		<td>
			<?=$country.CHtml::link($name,array('players/view','id'=>$name),$playerHtmlOptions).$points?>
			<div class="server"><?=$server?></div>
		</td>
		<td><?=$hero?></td>
		<td>
			<div align='center'><?=$kills?></div>
		</td>
		<td>
			<div align='center'><?=$deaths?></div>
		</td>
		<td>
			<div align='center'><?=$assists?></div>
		</td>
		<td>
			<div align='center'><?=$creepKills?></div>
		</td>
		<td>
			<div align='center'><?=$creepDenies?></div>
		</td>
		<td>
			<div align='center'><?=$neutralKills?></div>
		</td>
		<td>
			<div align='center'><?=$towerKills?></div>
		</td>
		<td>
			<div align='center'><?=$gold?></div>
		</td>
		<td>
			<div class='clearfix' style="width: <?=28*3?>;">
				<?php foreach($items as $item):?>
					<img  style="float:left;" title="" alt='' width='28' src='<?=$item['img']?>'>
				<?php endforeach ?>
			</div>
		</td>

		<td>
			<div align='left'><?=$left?></div>
		</td>
		<td>
			<div align='left'><span class='leftReason'><?=$leftReason?></span></div>
		</td>

	</tr>
<?php
	endif;
endforeach;
?>
</table>

<table>
	<tr>

		<td width='320' class='padLeft' align='left'>

			<b><?=__('app','Best Player')?>:</b>
			
			<?=CHtml::link($bestPlayer,array('players/view','id'=>strtolower($bestPlayer)));?>
			
		</td>

		<td class='padRight' align='left'>
			<h1>
				<b><?=__('app', 'Sentinel')?></b>
				<?=$sentinelKills?>:<?=$scourgeKills?>
				<b><?=__('app', 'Scourge')?></b>
			</h1>
		</td>

	</tr>
</table>
