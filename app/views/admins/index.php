<?php
$this->breadcrumbs = array(
	'Admins',
);

$this->menu = array(
	array('label' => 'Create Admins', 'url' => array('create')),
	array('label' => 'Manage Admins', 'url' => array('admin')),
);
$this->pageTitle = __('app', 'Admins');
?>

<h1>Admins</h1>
<table class='tableC'>
	<tr>
		<td style='height:24px;' width='30%'><?=__('apps', 'Head Administrator:')?>
			<span style='color:red'><?=param('headAdmin');?></span>
		</td>
		<td width='70%'>
			<?=__('app', 'Total Administrators: :count', array(':count' => $adminsCount))?>
		</td>
	</tr>
</table>
<table>
	<thead>
		<th><?=__('app', 'Admins');?></th>
		<th><?=__('app', 'Server');?></th>
	</thead>
	<tbody>
		<?php if ($adminsCount < 1): ?>
			<tr>
				<td class="noEntries" colspan="2">
					<?= __('app', 'No Admins found'); ?>
				</td>
			</tr>
		<? endif;?>
		<?php foreach ($admins as $admin): ?>
			<tr>
				<td><?=CHtml::link($admin['name'], array('players/view', 'id' => $admin['name']))?></td>
				<td><?=$admin['server']?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<table style='width:95%;margin:8px;'>
	<td class='padLeft' width='30%'>
		!stats [name]
	</td>
	<th></th>
	<th>Game Commands:</th>
	</tr>
	<td width='70%'>
		Display basic player statistics, optionally add [name] to display statistics for another player
	</td>
	</tr>
	<tr>
		<td class='padLeft' width='30%'>
			!statsdota [name]
		</td>
		<td width='70%'>
			Display DotA player statistics, optionally add [name] to display statistics for another player
		</td>
	</tr>
	<th></th>
	<th>Admin Commands:</th>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!priv [name]
		</td>
		<td width='70%'>
			Host a private game
		</td>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!pub [name]
		</td>
		<td width='70%'>
			Host a public game
		</td>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!unhost
		</td>
		<td width='70%'>
			Unhost the current game
		</td>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!swap [s1] [s2]
		</td>
		<td width='70%'>
			Swap slots
		</td>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!start [force]
		</td>
		<td width='70%'>
			Start game, optionally add [force] to skip checks
		</td>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!ping [number]
		</td>
		<td width='70%'>
			Ping players, optionally add [number] to kick players with ping above [number]
		</td>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!close [number]
		</td>
		<td width='70%'>
			Close slot
		</td>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!Open [number]
		</td>
		<td width='70%'>
			Open slot
		</td>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!ban [name] [reason]
		</td>
		<td width='70%'>
			Permabans [name] for [reason].
		</td>
	</tr>

	<tr>
		<td class='padLeft' width='30%'>
			!kick [partial name]
		</td>
		<td width='70%'>
			Kick [partial name] from game.
		</td>
	</tr>

</table>
