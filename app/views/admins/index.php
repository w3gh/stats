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

<h1><?=__('app','Admins')?></h1>
<table>
	<tr>
		<td><?=__('apps', 'Head Administrator:')?>
			<span class="label important head-admin"><?=param('headAdmin');?></span>
		</td>
		<td>
			<?=__('app', 'Total Administrators:')?>
			<span class="label admins-count"><?=$adminsCount?></span>
		</td>
	</tr>
</table>

<table id="admins" class="list zebra-striped">
	<thead>
		<th><?=__('app', 'Admins');?></th>
		<th><?=__('app', 'Server');?></th>
		<th><?=__('app', 'Games');?></th>
		<th><?=__('app', 'Bans');?></th>
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
				<td><?//=$admin['gameshosted']?></td>
				<td><?=$admin['banscount']?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?=$this->renderPartial('/site/pages/commands');?>