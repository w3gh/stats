<?php
$this->breadcrumbs=array(
	'Players',
);
$this->pageTitle=__('app','Players');

?>
<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
	<table id="players" class="list zebra-striped">
		<thead>
			<tr>
				<th><?= $sort->link('name', __('app', 'Name')); ?></th>
				<th><?= $sort->link('kills', __('app', 'Kills')); ?></th>
				<th><?= $sort->link('deaths', __('app', 'Deaths')); ?></th>
				<th><?= $sort->link('assists', __('app', 'Assists')); ?></th>
				<th><?= $sort->link('games', __('app', 'Games')); ?></th>
				<th><?= $sort->link('wins', __('app', 'Wins')); ?></th>
				<th><?= $sort->link('losses', __('app', 'Losses')); ?></th>
				<th><?= $sort->link('ratio', __('app', 'K\D Ratio')); ?></th>
				<th><?= $sort->link('creeps', __('app', 'Creeps')); ?></th>
				<th><?= $sort->link('denies', __('app', 'Denies')); ?></th>
				<th><?= $sort->link('neutral', __('app', 'Neutrals')); ?></th>
                <th>
                    <?=__('app','Server')?>
                    <div class="btn-group" data-toggle="buttons-checkbox">
                        <button class="btn btn-primary">eurobattle.net</button>
                        <button class="btn btn-primary">eswest</button>
                        <button class="btn btn-primary">rubattle.net</button>
                    </div>
                </th>
			</tr>
		</thead>
		<tbody>
			<?php if($playersCount < 1):?>
				<tr>
					<td class="noEntries" colspan="12">
						<?= __('app', 'No Games found'); ?>
					</td>
				</tr>
			<?endif;?>
			<?php foreach($players as $player): ?>
				<tr>
					<td>
							<?=CHtml::link($player['name'],
							               array('players/view','id'=>$player['name']),
														 array('class'=>'clearfix',
														      'rel'=>'popover',
															 'data-original-title'=>ucfirst($player['name']),
														 )

							)?>
							<span class="label server">servername</span>
					</td>
					<td><?=$player['kills']?></td>
					<td><?=$player['deaths']?></td>
					<td><?=$player['assists']?></td>
					<td><?=$player['totgames']?></td>
					<td><?=$player['wins']?></td>
					<td><?=$player['losses']?></td>
					<td><?=$player['kdratio']?></td>
					<td><?=$player['creepkills']?></td>
					<td><?=$player['creepdenies']?></td>
					<td><?=$player['neutralkills']?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
