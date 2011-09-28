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
<?=$this->renderPartial('/site/pages/commands');?>