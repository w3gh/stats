<?php

$dateFormat = param('dateFormat');

$creatorName =  $gameInfo['creatorname'];
$duration =     Util::secondsToTime($gameInfo['duration']);
$gameTime =     date($dateFormat, strtotime($gameInfo['datetime']));
$replayDate =   $gameInfo['datetime'];
$gameName =     $gameInfo['gamename'];
$win =          $gameInfo['winner'];

//fill defaults
$scourge =        1;
$sentinel =       1;
$sentinelKills =  0;
$scourgeKills =   0;
$myScore =        0;
$bestScore =      0;
$bestPlayer =     "";

$this->breadcrumbs = array(
	__('app','Games')=>array('index'),
	$gameName
);

$this->pageTitle=$this->title=$gameName

/**
 * @TODO Country Flags will be released as widget
 * @TODO User points mod will be released as widget
 * @TODO Replay Link Will be released as widget
 * @TODO Replay Chat will be released as widget
 */

?>

<table id="game-info" class="list">
	<tr class="gradient">
		<td class="info-row"><?=__('app', 'Game')?>: <b><?= $gameName; ?></b></td>
		<td class="info-row"><?=__('app', 'Date')?>: <b><?= $gameTime; ?></b></td>
		<td class="info-row"><?=__('app', 'Creator')?>: <b><?= (!empty($creatorName)) ? $creatorName:__('app','Autohosted'); ?></b></td>
		<td class="info-row"><?=__('app', 'Duration')?>: <b><?= $duration; ?></b></td>
		<td><a class="btn success" href="#">DownloadReplay</a></td>
	</tr>
</table>

<table id="game" class="list zebra-striped">
	<thead>
		<tr>
			<th><?=__('app', 'Player')?></th>
			<th><?=__('app', 'Hero')?></th>
			<th><?=__('app', 'Kills')?></th>
			<th><?=__('app', 'Deaths')?></th>
			<th><?=__('app', 'Assists')?></th>
			<th><?=__('app', 'Creeps')?></th>
			<th><?=__('app', 'Denies')?></th>
			<th><?=__('app', 'Neutrals')?></th>
			<th><?=__('app', 'Towers')?></th>
			<th><?=__('app', 'Gold')?></th>
			<th><?=__('app', 'Items')?></th>
			<th><?=__('app', 'Left at')?></th>
<!--			<th>--><?//=__('app', 'Reason')?><!--</th>-->
		</tr>
	</thead>
<?php

foreach ($gameStats as $player):
	
	//$player = new ArrayObject($player);
	//var_dump($player);die();
	$kills =        $player['kills'];
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
	$newColour=     $player["newcolour"];
	$gameId=        $player["gameid"];
	$banName=       $player["banname"];
	$country = '';
	$points = '';

	$items = array();

	for ($i = 1; $i <= 6; ++$i)
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


	if ($hero != "")
	{
		$hero = CHtml::link(
			CHtml::image($this->assetsUrl.'/img/heroes/'.$hero.'.gif','',array('width'=>28)),
			array('heroes/view','id'=>$hero),
			array('title'=>$heroName,'rel'=>'popover')
		);
	}
	else
	{
		$hero = CHtml::image($this->assetsUrl.'/img/heroes/blank.gif','',array('width'=>28));
	}

	if (empty($nameId))
	{
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
	if ($kills >= 10)
	{
		$kills = "<b>{$kills}</b>";
	}
	if ($deaths >= 10)
	{
		$deaths = "<b>{$deaths}</b>";
	}
	if ($assists >= 10)
	{
		$assists = "<b>{$assists}</b>";
	}

	if ($creepKills >= 60)
	{
		$creepKills = "<b>{$creepKills}</b>";
	}

	if ($creepDenies >= 10)
	{
		$creepDenies = "<b>{$creepDenies}</b>";
	}

	if ($neutralKills >= 30)
	{
		$neutralKills = "<b>{$neutralKills}</b>";
	}

	if ($towerKills >= 2)
	{
		$towerKills = "<b>{$towerKills}</b>";
	}

	if ($gold >= 2500)
	{
		$gold = "<b>$gold</b>";
	}

	$myScore = ($kills - $deaths + $assists * 0.5) + ($towerKills * 0.3 + $raxkills * 0.3);

	if ($myScore > $bestScore AND $kills > 0) {
		$bestPlayer = $name;
		$bestScore = ($kills - $deaths + $assists * 0.5) + ($towerKills * 0.3 + $raxkills * 0.3);
	}

	/* Player Row */
	$playerHtmlOptions=array('title'=>$player['name'],'rel'=>'popover');

	$playerName=CHtml::link($name,array('players/view','id'=>$name),$playerHtmlOptions);

	if($country)
		$playerName.=CHtml::tag('span',array('class'=>'label country'),$country);
	if($points)
		$playerName.=CHtml::tag('span',array('class'=>'label points'),$points);

	if ($player['name'] && (trim(strtolower($player['banname'])) == strtolower($player['name']))) {
		$playerName.=CHtml::tag('span',array('class'=>'label banned'),__('app','Banned'));
	}

	if ($player['name'] && (trim(strtolower($player['adminname'])) == strtolower($player['name']))) {
		$playerName.=CHtml::tag('span',array('class'=>'label admin'),__('app','Admin'));
	}

	//Trim down the leftreason Useful only for US
	//@TODO Rework for multi lang support
	$leftReason = str_ireplace("has", "", $leftReason);
	$leftReason = str_ireplace("was", "", $leftReason);
	$leftReason = ucfirst(trim($leftReason));
	$substring =  strchr($leftReason, "(");
	$leftReason = str_replace($substring, "", $leftReason);

	/**
	 * Detect loser/winer
	 */
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
	<tr class='sentinel-row'>
		<td colspan='12'>
            <span class='sentinel-col'><?=__('app', 'Sentinel')?></span>
			<span class='sentinel-col'><?=$sentinelResult?></span>
        </td>
	</tr>
<?php

	}

	if ($scourge == 1 AND $newColour > 5)
	{
		$scourge = 0;
?>
		<tr class='scourge-row'>
			<td colspan='12'>
                <span class='scourge-col'><?=__('app', 'Scourge')?></span>
				<span class='scourge-col'><?=$scourgeResult?></span>
            </td>
		</tr>
<?php
	}

	if (!empty($nameId) || param('showAllSlotsInGame')):
?>
	<tr>
		<td>
			<?=$playerName?>
			<?=($server) ? Chtml::tag('span',array('class'=>'label server'),$server):''?>
		</td>
		<td><?=$hero?></td>
		<td><?=$kills?></td>
		<td><?=$deaths?></td>
		<td><?=$assists?></td>
		<td><?=$creepKills?></td>
		<td><?=$creepDenies?></td>
		<td><?=$neutralKills?></td>
		<td><?=$towerKills?></td>
		<td><?=$gold?></td>
		<td>
			<div class='clearfix' style="width: <?=16*3?>;">
				<?php foreach($items as $item):?>
					<img  style="float:left;" title="" alt='' width='16' src='<?=$item['img']?>'>
				<?php endforeach; ?>
			</div>
		</td>

		<td>
			<abbr title="<?=$leftReason?>"><?=$left?></abbr>
		</td>

	</tr>
<?php
	endif;
endforeach;
?>
</table>

<table>
	<tr>

<!--		<td>-->
<!--			--><?//=__('app','Best Player')?><!--:-->
<!--			--><?//=CHtml::link($bestPlayer,array('players/view','id'=>strtolower($bestPlayer)));?>
<!--		</td>-->

		<td>
			<h1 class="winer-loser">
				<b><?=__('app', 'Sentinel')?></b>
				<?=$sentinelKills?>:<?=$scourgeKills?>
				<b><?=__('app', 'Scourge')?></b>
			</h1>
		</td>

	</tr>
</table>

<div class="hero-unit">
    <h3>Comments</h3>

    <?php $this->renderPartial('comment.views.comment.commentList', array(
    	'model'=>$model
    )); ?>
</div>