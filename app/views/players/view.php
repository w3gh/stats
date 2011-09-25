<?php

$this->breadcrumbs = array(
	__('app', 'Players') => array('index'),
	$id
);

?>
<table>
	<tr>
		<td style='width:36%;padding-left:8px; height:24px;'>
			<div align='left'>

				<a href='<?=$this->createUrl('heroes/player', array('id' => $id))?>'>
					<?=__('app', 'Show Hero Stats for')?>:
					<span><?=$id?></span>
				</a>
			</div>
		</td>
		<td>
			<div align='left'>
				<?=__('app', 'Player History for')?>:
				<b><?=$id?> <?php /*$myFlag <span $COLOR>$BANNED</span>*/?></b>
			</div>
		</td>
	</tr>
</table>


<div>
	<table class='tableA'>
		<tr>
			<th width='38%'>
				<div align='center'><?=__('app','All Time Stats')?>:</div>
			</th>
			<th width='62%'>
				<div align='center'><?=__('app','Highest Hero Stats')?>:</div>
			</th>
		</tr>
		<tr>
			<td>
				<?php $this->widget('PlayerStats',array('player'=>$id))?>
			</td>
			
			<td class='tableUserRowHero'>
				<table height='175' style='text-align:center;'>
					<tr valign='bottom'>
						<td><?php $this->widget('MostKillsHero',array('player'=>$id)) ?></td>
						<td><?php $this->widget('MostDeathsHero',array('player'=>$id)) ?></td>
						<td><?php $this->widget('MostAssistsHero',array('player'=>$id)) ?></td>
						<td><?php $this->widget('MostWinsHero',array('player'=>$id)) ?></td>
						<td><?php $this->widget('MostLossesHero',array('player'=>$id)) ?></td>
						<td><?php $this->widget('MostPlayedHero',array('player'=>$id)) ?></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
</div>
	<?php $this->widget('PlayerGamesDurations',array('player'=>$id))?>
	<?php $this->widget('PlayerFastestGamesWon',array('player'=>$id))?>
	<?php $this->widget('PlayerLongestGamesWon',array('player'=>$id))?>
	<?php $this->widget('PlayerAchievements',array('player'=>$id))?>

<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
<table>
	<thead>
		<tr>
			<th><?= $sort->link('game', __('app', 'Game Name')); ?></th>
			<th><?= $sort->link('type', __('app', 'Type')); ?></th>
			<th><?= $sort->link('date', __('app', 'Date')); ?></th>
			<th><?= $sort->link('hero', __('app', 'Hero Played')); ?></th>
			<th><?= $sort->link('kills', __('app', 'Kills')); ?></th>
			<th><?= $sort->link('deaths', __('app', 'Deaths')); ?></th>
			<th><?= $sort->link('assists', __('app', 'Assists')); ?></th>
			<th><?= $sort->link('ratio', __('app', 'K\D')); ?></th>
			<th><?= $sort->link('creeps', __('app', 'Creeps')); ?></th>
			<th><?= $sort->link('denies', __('app', 'Denies')); ?></th>
			<th><?= $sort->link('neutral', __('app', 'Neutrals')); ?></th>
			<th><?= $sort->link('result', __('app', 'Result')); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php if(count($games) < 1):?>
		<tr>
			<td colspan='12'><?=__('app','No Games found')?></td>
		</tr>
	<?php endif;?>
		<?php foreach($games as $list):?>
		<?php
			$dateFormat = param('dateFormat');
		
			$gametime=      date($dateFormat,strtotime($list["datetime"]));
			$kills=         $list["kills"];
			$death=         $list["deaths"];
			$assists=       $list["assists"];
			$gamename=      trim($list["gamename"]);
			$hid=           strtoupper($list["original"]);
			$hero=          $list["description"];
			$name=          trim($list["name"]);
			$colour=        $list["newcolour"];
			$winner=        $list["winner"];
			$gameid=        $list["id"];
			$type=          $list["type"];
			$outcome=       $list["outcome"];
			$kdratio =      round($list["kdratio"],1);

			$creepkills=    $list["creepkills"];
			$creepdenies=   $list["creepdenies"];
			$neutralkills=  $list["neutralkills"];
		
			if ($kdratio == "1000") $kdratio = "10";

			if ($outcome == __('app','Lost'))
			{
				$outcome="<span style='color:#B30505'>{$list['outcome']}</span>";
				$gamename="<span style='color:#B30505'>{$list['gamename']}</span>";
			}

			if ($outcome == __('app','Won'))
			{
				$outcome="<span style='color:#0E9A00'>{$list['outcome']}</span>";
				$gamename="<span style='color:#0E9A00'>{$list['gamename']}</span>";
			}
			if ($outcome == __('app','Draw'))
			{
				$outcome="<span style='color:#4368BB'>{$list['outcome']}</span>";
				$gamename="<span style='color:#4368BB'>{$list['gamename']}</span>";
			}
			if ($outcome == __('app','Leaver'))
			{
				$outcome="<span style='color:#7E7E7E'>{$list['outcome']}</span>";
				$gamename="<span style='color:#7E7E7E'>{$list['gamename']}</span>";
			}
			$hero_img = "<a href='".$this->createUrl('heroes/view',array('id'=>$hid))."'><img border=0 alt='' title='$hero' width='28' style='vertical-align: middle;' src='{$this->assetsUrl}/img/heroes/$hid.gif'/></a>";

		?>
		<tr>
			<td width="200" class="padLeft"><div align='left'><a href='<?=$this->createUrl('games/view',array('id'=>$gameid))?>'><?=$gamename?></a></div></td>
			<td width="30"><?=$type?></td>
			<td width="150"><div align='center'><?=$gametime?></div></td>
			<td width="180" height="32"><div align='left'><?=$hero_img?> <?=$hero?></div></td>
			<td width="40" align='center'><?=$kills?></td>
			<td width="40" align='center'><?=$death?></td>
			<td width="60" align='center'><?=$assists?></td>
			<td width="60" align='center'><?=$kdratio?>:1</td>
			<td width="60" align='center'><?=$creepkills?></td>
			<td width="60" align='center'><?=$creepdenies?></td>
			<td width="60" align='center'><?=$neutralkills?></td>
			<td width="60" align='center'><div align='left'><?=$outcome?></div></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php $this->widget('LinkPager', array('pages' => $pages)); ?>