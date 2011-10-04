<table class="list zebra-striped">
	<tbody>
	
		<tr>
			<td><b><?=__('app', 'Kills')?>:</b></td>
			<td><?=$kills?></td>
			<td><b><?=__('app', 'Assists')?>:</b></td>
			<td><?=$assists?></td>
		</tr>

		<tr>
			<td><b><?=__('app', 'Deaths')?>:</b></td>
			<td><?=$deaths?></td>
			<td><abbr title="<?=__('app', 'Kills\Deaths Ratio per Game')?>"><b><?=__('app', 'K\D')?>:</b></abbr></td>
			<td><?=$kdratio?>:1</td>
		</tr>

		<tr>
			<td><b><?=__('app', 'Games')?>:</b></td>
			<td><?=$totalGames?></td>
			<td><abbr title="<?=__('app', 'Wins\Looses')?>"><b><?=__('app', 'W\L')?>:</b></abbr></td>
			<td><?=$wins?>/<?=$losses?></td>
		</tr>

		<tr>
			<td><b><?=__('app', 'Score')?>:</b></td>
			<td>{TC}</td>
			<td><abbr title="<?=__('app', 'Wins Percent')?>"><b><?=__('app', 'Win %')?>:</b></abbr></td>
			<td><?=$winLoose?> %</td>
		</tr>

		<tr>
			<td><abbr title="<?=__('app', 'Creep Kills')?>"><b><?=__('app', 'CK')?>:</b></abbr></td>
			<td><?=$creepKills?></td>
			<td><b><?=__('app', 'Towers')?>:</b></td>
			<td><?=$towerKills?></td>
		</tr>

		<tr>
			<td><abbr title="<?=__('app', 'Creeps Denies')?>"><b><?=__('app', 'CD')?></b>:</abbr></td>
			<td><?=$creepDenies?></td>
			<td><b><?=__('app', 'Rax')?>:</b></td>
			<td><?=$raxKills?></td>
		</tr>

		<tr>
			<td><abbr title="<?=__('app', 'Creeps Per Minute')?>"><b><?=__('app', 'CPM')?></b>:</abbr></td>
			<td><?=$creepsPerMin?></td>
			<td><abbr title="<?=__('app', 'Kills Per Game')?>"><b><?=__('app', 'KPG')?>:</b></abbr></td>
			<td><?=$killsPerGame?></td>
		</tr>

		<tr>
			<td><b><?=__('app', 'Couriers')?>:</b></td>
			<td><?=$courierKills?></td>
			<td><b><?=__('app', 'Disc')?></b></td>
			<td>{DC}</td>
		</tr>

	</tbody>
</table>