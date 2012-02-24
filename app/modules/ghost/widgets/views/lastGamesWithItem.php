<div align="center">
	<table class='tableHeroPageTop'>
		<tr>
			<th>
				<div align='center'>
					<?=__('app','Last :limit games with :itemShortName',array(
				                                    ':limit'=>$this->limit,
				                                    ':itemShortName'=>$this->itemShortName))?>
				</div>
			</th>
		</tr>

		<tr>
			<td>

				<table>
					<thead>
						<tr>
							<th><?=__('app','Game');?></th>
							<th><?=__('app','Duration');?></th>
							<th><?=__('app','Date');?></th>
							<th><?=__('app','Creator');?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($this->lastGamesWithItem as $row):
							$date = date(param('dateFormat'), strtotime($row['datetime']));
							$creator = strtolower($row['creator']);
							$gamename = $row['gname'];
							$winner = $row['winner'];
							$htmlOptions = array();
							if ($winner == 1) {	$htmlOptions['class'] = 'GamesSentinel'; }
							if ($winner == 2) {	$htmlOptions['class'] = 'GamesScourge';	}

							?>
							<tr>
								<td class="padAll">
									<a href='<?=$this->owner->createUrl('games/view',array('id'=>$row['gid'], 'item'=>$this->itemId))?>'>
										<span class="class"><?=CHtml::tag('span',$htmlOptions,$gamename)?></span>
									</a></td>
								<td class="padAll"><?=Util::secondsToTime($row['duration'])?></td>
								<td class="padAll"><?=$date?></td>
								<td class="padAll"><a href="<?=$this->owner->createUrl('user/view',array('id'=>$creator))?>"><?=$row['creator']?></a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

			</td>
		</tr>
	</table>
	
</div>
<div class="clear"></div>