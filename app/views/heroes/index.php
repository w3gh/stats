<?php
$this->breadcrumbs = array(
	'Heroes',
);

$this->menu = array(
	array('label' => 'Create Heroes', 'url' => array('create')),
	array('label' => 'Manage Heroes', 'url' => array('admin')),
);
$this->pageTitle = __('app', 'Heroes');

if (!$playername)
	$showStatsFor = __('app','Hero Statistics for All Games');
else
	$showStatsFor = __('app','Hero Statistics for: :user',array(
		                            ':user'=> $playername ));


?>
<table>
	<tr>
		<td class="tableB"><?=$showStatsFor?></td>
	</tr>
</table>
<div style="clear: both;">&nbsp;</div>
<?/*
<?php
	$sql = "SELECT * FROM heroes WHERE summary!= '-' ORDER BY LOWER(description) ASC";
$result = $db->query($sql);
?>
<form name="myForm" method="post" action="">
	<select id="buildUrl2" name="searchterm"><?php
	$c = -1;
		while ($list = $db->fetch_array($result, 'assoc')) {
			$hero = $list['description'];
			$c++;
			?>
			<option value='includes/ajax_get_hero.php?searchterm=<?=$list["original"]?>'><?=$list["description"]?></option>
			<?php
		}
		?></select>
	<input maxlength="42" type="hidden" id="text1"/>
	<input maxlength="42" type="hidden" id="text2"/>
	<input maxlength="42" type="hidden" id="text3"/>
	<input maxlength="42" type="hidden" id="text4"/>
	<input type="button" onclick="requestActivities()" class="inputButton" value="<?=$lang["hero_sel"]?>"/>

	<div id='divActivities2'></div>
</form>
<div style="clear: both;">&nbsp;</div>
*/?>
<div align='center'>
<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
<table class="zebra-striped">
		<!-- <colgroup>
			<col class="checkbox" />
			<col />
			<col class="action" />
			<col class="action" />
			<col class="action" />
			<col class="action" />
			<col class="action" />
			<col class="action" />
			<col class="action" />
			<col class="count" />
			<col class="engine" />
			<col class="collation" />
			<col class="filesize" />
			<col class="filesize" />
		</colgroup> -->
		<thead>
			<tr>
				<th><?= $sort->link('hero', __('app', 'Hero')); ?></th>
				<th><?= $sort->link('played', __('app', 'Played')); ?></th>
				<th><?= $sort->link('wins', __('app', 'Wins')); ?></th>
				<th><?= $sort->link('losses', __('app', 'Losses')); ?></th>
				<th><?= $sort->link('w_l', __('app', 'Win\Loses')); ?></th>
				<th><?= $sort->link('kills', __('app', 'Kills')); ?></th>
				<th><?= $sort->link('deaths', __('app', 'Deaths')); ?></th>
				<th><?= $sort->link('assists', __('app', 'Assists')); ?></th>
				<th><?= $sort->link('kd', __('app', 'Kill\Deaths')); ?></th>
				<th><?= $sort->link('creeps', __('app', 'Creeps')); ?></th>
				<th><?= $sort->link('denies', __('app', 'Denies')); ?></th>
				<th><?= $sort->link('neutrals', __('app', 'Neutrals')); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php if($heroesCount < 1):?>
			<tr>
				<td class="noEntries" colspan="12">
					<?= __('app', 'No Heroes found'); ?>
				</td>
			</tr>
		<?endif;?>
		
		<?php foreach($heroes as $id => $list): ?>
			<?php
			$hero =         $list["description"];
			$totgames =     $list["totgames"];
			$wins =         $list["wins"];
			$losses =       $list["losses"];
			$winratio =     round($list["winratio"], 2);

			$kills =        round($list["kills"], 2);
			$deaths =       round($list["deaths"], 2);
			$assists =      round($list["assists"], 2);
			$kdratio =      round($list["kdratio"], 2);
			$creepkills =   round($list["creepkills"], 2);
			$creepdenies =  round($list["creepdenies"], 2);
			$neutralkills = round($list["neutralkills"], 2);
			$hid =          strtoupper($list["original"]);
			?>

			<tr>

				<td>
					<a href='<?=$this->createUrl('view',array('id'=>$hid))?>'>
						<img width='32' height='32' alt='' src='<?=$this->assetsUrl?>/img/heroes/<?=$hid?>.gif' border=0 />
					</a>
					<a href='<?=$this->createUrl('view',array('id'=>$hid))?>'><?=$hero?></a>
				</td>
				<td><div align='center'><?=$totgames?></div></td>
				<td><div align='center'><?=$wins?></div></td>
				<td><div align='center'><?=$losses?></div></td>
				<td><div align='center'><?=$winratio?></div></td>
				<td><div align='center'><?=$kills?></div></td>
				<td><div align='center'><?=$deaths?></div></td>
				<td><div align='center'><?=$assists?></div></td>
				<td><div align='center'><?=$kdratio?></div></td>
				<td><div align='center'><?=$creepkills?></div></td>
				<td><div align='center'><?=$creepdenies?></div></td>
				<td><div align='center'><?=$neutralkills?></div></td>
				
			</tr>
		<?php endforeach; ?>
		</tbody>
</table>
	<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
</div>


<div class="clear"></div>
<?php  //$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//));
?>
