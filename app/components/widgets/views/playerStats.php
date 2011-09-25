<table border=0 class='tableUserRow'>
	
	<tr>
		<td align='right'><b><?=__('app', 'Kills')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$kills?></td>
		<td align='right'><b><?=__('app', 'Assists')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$assists?></td>
	</tr>

	<tr>
		<td align='right'><b><?=__('app', 'Deaths')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$deaths?></td>
		<td align='right'>
			<b><?=__('app', 'K\D')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$kdratio?>:1</td>
	</tr>

	<tr>
		<td align='right'><b><?=__('app', 'Games')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$totalGames?></td>
		<td align='right'>

			<b><?=__('app', 'W\L')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$wins?>/<?=$losses?></td>
	</tr>

	<tr>
		<td align='right'><b><?=__('app', 'Score')?>:</b></td>
		<td class='tableUserRowHero' align='left'>{TOTSCORE}</td>
		<td align='right'>

			<b><?=__('app', 'Win %')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$winLoose?> %</td>
	</tr>

	<tr>
		<td align='right'><b><?=__('app', 'Creep Kills')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$creepKills?></td>
		<td align='right'><b><?=__('app', 'Towers')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$towerKills?></td>
	</tr>

	<tr>
		<td align='right'><b><?=__('app', 'Creep Denies')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$creepDenies?></td>
		<td align='right'><b><?=__('app', 'Rax')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$raxKills?></td>
	</tr>

	<tr>
		<td align='right'>
			<b><?=__('app', 'Creeps Per Minute')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$creepsPerMin?></td>
		<td align='right'>
			<b><?=__('app', 'Kills Per Game')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$killsPerGame?></td>
	</tr>

	<tr>
		<td align='right'><b><?=__('app', 'Couriers')?>:</b></td>
		<td class='tableUserRowHero' align='left'><?=$courierKills?></td>
		<td align='right'>
			<b><?=__('app', 'Disc')?></b>
		</td>
		<td class='tableUserRowHero' align='left'>{DISC}</td>
	</tr>

</table>