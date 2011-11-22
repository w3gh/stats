<table id='playerLongestGamesWon' class='list'>
	<thead>
		<tr>
			<th colspan='8' ><?=__('app','Longest Game Won')?></th>
		</tr>
		<tr>
			<th><?=__('app','Game Name')?></th>
			<th><?=__('app','Duration')?></th>
			<th><?=__('app','Kills')?></th>
			<th><?=__('app','Deaths')?></th>
			<th><?=__('app','Assists')?></th>
			<th><?=__('app','Creeps')?></th>
			<th><?=__('app','Denies')?></th>
			<th><?=__('app','Neutrals')?></th>
		</tr>
	</thead>
	<tbody>
	<?php if(count($games) < 1): ?>
		<tr>
			<td colspan='8'>
				<?=__('app','No Games found')?>
			</td>
		</tr>
	<?php endif; ?>
	<?php foreach($games as $game): ?>
		  <tr>
		    <td  width='180'  class='padLeft'>
			    <div align='left'>
				    <a href='<?=$this->owner->createUrl('games/view',array('id'=>$game["gameid"]))?>'><?=$game["gamename"]?></a>
			    </div>
		    </td>
		    <td width='120'><div align='left'><?=Util::secondsToTime($game["duration"]);?></div></td>
		    <td width='56'><div align='center'><?=$game["kills"];?></div></td>
		    <td width='56'><div align='center'><?=$game["deaths"];?></div></td>
		    <td width='56'><div align='center'><?=$game["assists"];?></div></td>
		    <td width='56'><div align='center'><?=$game["creepkills"];?></div></td>
		    <td width='56'><div align='center'><?=$game["creepdenies"];?></div></td>
		    <td width='56'><div align='center'><?=$game["neutralkills"];?></div></td>
		  </tr>
	<?php endforeach; ?>
	</tbody>
</table>