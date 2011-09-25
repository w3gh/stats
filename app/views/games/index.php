<?php
$this->breadcrumbs=array(
	'Games',
);
$this->pageTitle=__('app','Dota Games');
?>

<?php
/*

  if ($FiltersOnGamePage == 1) {
  if (isset($_POST["years"])) {$sql_year = "AND YEAR(datetime) = '".safeEscape($_POST["years"])."'";}
  else $sql_year = "";
  if (isset($_POST["months"])) {$sql_month = "AND MONTH(datetime) = '".safeEscape($_POST["months"])."'";}
  else   $sql_month = "";
  if (isset($_POST["days"]) AND $_POST["days"]>0)
  {$sql_day = "AND DAYOFMONTH(datetime) = '".safeEscape($_POST["days"])."'";}
  else $sql_day = "";
  if (isset($_GET["y"])) {$sql_year = "AND YEAR(datetime) = '".safeEscape($_GET["y"])."'";}
  if (isset($_GET["m"])) {$sql_month = "AND MONTH(datetime) = '".safeEscape($_GET["m"])."'";}
  if (isset($_GET["d"]) AND $_GET["d"]>0)
  {$sql_day = "AND DAYOFMONTH(datetime) = '".safeEscape($_GET["d"])."'";}
  } else {$sql_year =""; $sql_month =""; $sql_day=""; }

*/

  //Show sentinel and scourge won
  /*
  if ($ShowSentinelScourgeWon == 1)
    {require_once("./includes/get_games_summary.php");}

	if ($FiltersOnGamePage == 1) {
	require_once('./includes/get_games_filter.php');
	}
    include('pagination.php');
	*/

  ?>
<?php $this->widget('GamesSummary');?>

<div class="clearfix">
            <label>Date Range</label>
            <div class="input">
              <div class="inline-inputs">
                <input class="small" type="text" value="May 1, 2011">
                <input class="mini" type="text" value="12:00am">
                to
                <input class="small" type="text" value="May 8, 2011">
                <input class="mini" type="text" value="11:59pm">
                <span class="help-inline">All times are shown as Pacific Standard Time (GMT -08:00).</span>
              </div>
            </div>
</div>
<div align='center'>
	<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
	<table class='tableA'>
		<thead>
			<tr>
				<th><?= $sort->link('game', __('app', 'Game')); ?></th>
				<th><?= $sort->link('duration', __('app', 'Duration')); ?></th>
				<th><?= $sort->link('type', __('app', 'Type')); ?></th>
				<th><?= $sort->link('date', __('app', 'Date')); ?></th>
				<th><?= $sort->link('creator', __('app', 'Creator')); ?></th>
			</tr>
		</thead>
			<?php if($gamesCount < 1):?>
				<tr>
					<td class="noEntries" colspan="5">
						<?= __('app', 'No Games found'); ?>
					</td>
				</tr>
			<?endif;?>
			<?php foreach($games as $list): ?>
				<?php

					$gid=$list["id"];
					$map=CHtml::encode(substr($list["map"], strripos($list["map"], '\\')+1));
					$type=$list["type"];

					$gametime=date(param('dateFormat'),strtotime($list["datetime"]));
					$gamename=trim($list["gamename"]);
					$ownername=$list["ownername"];
					$duration=Util::secondsToTime($list["duration"]);
					$creator=trim($list["creatorname"]);
					$creatorId=trim(strtolower($list["creatorname"]));
					$winner=$list["winner"];
					$dispWinner = "";

					if ($winner == 1) {
						$dispWinner = __('app','<b>Map</b>: :map <br> <b>Winner</b> Sentinel',array(':map'=>$map));
						$gamename = "<span class='GamesSentinel'>$gamename</span>";
					}

					if ($winner == 2) {
						$dispWinner = __('app','<b>Map</b>: :map <br> <b>Winner</b> Scourge',array(':map'=>$map));
						$gamename = "<span class='GamesScourge'>$gamename</span>";}

					if ($winner == 0) {
						$dispWinner = __('app','<b>Map</b>: :map <br> <b>Winner</b> Draw Game',array(':map'=>$map));
						$gamename = "<span class='GamesDraw'>$gamename</span>";
					}
				?>
				<tr>
					<td class='tableD' width='300'>
						<div align='left'>
							<?=CHtml::link($gamename,
							               array(
							                    'view',
								                  'id'=>$gid
							               ),
							               array(
							                    'data-title'=>$dispWinner
							               )
							);?>
						</div>
					</td>
					<td width='160'><div align='left'><?=$duration?></div></td>
					<td width='100'><div align='left'><?=$type?></div></td>
					<td width='200'><div align='left'><?=$gametime?></div></td>
					<td width='200'>
						<div align='left'>
							<?=CHtml::link($creator,
							               array(
							                    'players/view',
								                  'id'=>$creatorId
							               )
							);?>
							<?=(!$creator) ? __('app','Autohosted'):'';?>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
	</table>
	<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
</div>
