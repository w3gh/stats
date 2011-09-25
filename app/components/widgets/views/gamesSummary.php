<div align='center'>
	<table class='tableA'>
		<tr>
			<th class='padLeft'></th>
			<th>
				<div align='left'><?=__('app','Total: Wins')?></div>
			</th>
			<th>
				<div align='center'><?=__('app','Kills')?></div>
			</th>
			<th>
				<div align='center'><?=__('app','Deaths')?></div>
			</th>
			<th>
				<div align='center'><?=__('app','Assists')?></div>
			</th>
			<th>
				<div align='center'><?=__('app','Creep Kills')?></div>
			</th>
			<th>
				<div align='center'><?=__('app','Denies')?></div>
			</th>
			<th>
				<div align='center'><?=__('app','Towers')?></div>
			</th>
			<th>
				<div align='center'><?=__('app','Rax')?></div>
			</th>
			<th>
				<div align='center'><?=__('app','Couriers')?></div>
			</th>
			<th></th>
		</tr>
		<tr class=''>
			<td class='padLeft' width='90px'><span class='sentinel'><b><?=__('app','Sentinel')?></b></span></td>
			<td width='90px'><?= $sentinelWon . " (" . $sentinelPercent;?>%)</td>
			<td align='center' width='90px'><?=$sentinel['totalKills']?></td>
			<td align='center' width='90px'><?=$sentinel['totalDeaths']?></td>
			<td align='center' width='90px'><?=$sentinel['totalAssists']?></td>
			<td align='center' width='90px'><?=$sentinel['totalCreepKills']?></td>
			<td align='center' width='90px'><?=$sentinel['totalCreepDenies']?></td>
			<td align='center' width='90px'><?=$sentinel['totalTowers']?></td>
			<td align='center' width='90px'><?=$sentinel['totalRax']?></td>
			<td align='center' width='90px'><?=$sentinel['totalCourier']?></td>
			<td></td>

		<tr class=''>
			<td class='padLeft' width='90px'><span class='scourge'><b><?=__('app','Scourge')?></b></span></td>
			<td width='90px'><?= $scourgeWon . " (" . $scourgePercent;?>%)</td>
			<td align='center' width='90px'><?=$scourge['totalKills']?></td>
			<td align='center' width='90px'><?=$scourge['totalDeaths']?></td>
			<td align='center' width='90px'><?=$scourge['totalAssists']?></td>
			<td align='center' width='90px'><?=$scourge['totalCreepKills']?></td>
			<td align='center' width='90px'><?=$scourge['totalCreepDenies']?></td>
			<td align='center' width='90px'><?=$scourge['totalTowers']?></td>
			<td align='center' width='90px'><?=$scourge['totalRax']?></td>
			<td align='center' width='90px'><?=$scourge['totalCourier']?></td>
			<td></td>

		<tr class=''>
			<td class='padLeft' width='90px'><span class='GamesDraw'><?=__('app','Draw Game')?></span></td>
			<td width='120px'><?= $draw . " (" . $drawPercent;?>%)</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>

	<table class='tableA'>
		<tr>
			<th width='33%' class='padLeft'><?= __('app','Total Games: :total',array(':total'=>$totalGames))?></th>
			<th width='33%'><?=__('app','Average Duration: :duration',array(':duration'=>$avgDuration))?></th>
			<th width='33%'><?=__('app','Total Duration :duration',array(':duration'=>$totalDuration))?></th>
		</tr>
	</table>
</div>