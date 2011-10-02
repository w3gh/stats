<table id="gamesSummary">
	<thead>
		<tr>
			<th></th>
			<th>
				<?=__('app', 'Total: Wins')?>
			</th>
			<th>
				<?=__('app', 'Kills')?>
			</th>
			<th>
				<?=__('app', 'Deaths')?>
			</th>
			<th>
				<?=__('app', 'Assists')?>
			</th>
			<th>
				<?=__('app', 'Creep Kills')?>
			</th>
			<th>
				<?=__('app', 'Denies')?>
			</th>
			<th>
				<?=__('app', 'Towers')?>
			</th>
			<th>
				<?=__('app', 'Rax')?>
			</th>
			<th>
				<?=__('app', 'Couriers')?>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><span class='sentinel'><b><?=__('app', 'Sentinel')?></b></span></td>
			<td><?=$sentinelWon?>(<?=$sentinelPercent?>%)</td>
			<td><?=$sentinel['totalKills']?></td>
			<td><?=$sentinel['totalDeaths']?></td>
			<td><?=$sentinel['totalAssists']?></td>
			<td><?=$sentinel['totalCreepKills']?></td>
			<td><?=$sentinel['totalCreepDenies']?></td>
			<td><?=$sentinel['totalTowers']?></td>
			<td><?=$sentinel['totalRax']?></td>
			<td><?=$sentinel['totalCourier']?></td>
		</tr>
		<tr>
			<td><span class='scourge'><b><?=__('app', 'Scourge')?></b></span></td>
			<td><?=$scourgeWon?>(<?=$scourgePercent?>%)</td>
			<td><?=$scourge['totalKills']?></td>
			<td><?=$scourge['totalDeaths']?></td>
			<td><?=$scourge['totalAssists']?></td>
			<td><?=$scourge['totalCreepKills']?></td>
			<td><?=$scourge['totalCreepDenies']?></td>
			<td><?=$scourge['totalTowers']?></td>
			<td><?=$scourge['totalRax']?></td>
			<td><?=$scourge['totalCourier']?></td>
		</tr>
		<tr>
			<td><span class='GamesDraw'><?=__('app', 'Draw Game')?></span></td>
			<td><?=$draw?>(<?=$drawPercent?>%)</td>
			<td colspan="8"></td>
		</tr>
		<tr>
			<td colspan="3"><?= __('app', 'Total Games: :total', array(':total' => $totalGames))?></td>
			<td colspan="3"><?=__('app', 'Average Duration: :duration', array(':duration' => $avgDuration))?></td>
			<td colspan="4"><?=__('app', 'Total Duration :duration', array(':duration' => $totalDuration))?></td>
		</tr>
	</tbody>
</table>