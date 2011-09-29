<?php
$this->breadcrumbs=array(
	'Bans',
);

$this->menu=array(
	array('label'=>'Create Bans', 'url'=>array('create')),
	array('label'=>'Manage Bans', 'url'=>array('admin')),
);
$this->pageTitle=__('app','Bans');
?>

<h1>Bans</h1>
<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
<table>
	<thead>
		<tr>
			<th><?=$sort->link('id',__('app','id'))?></th>
			<th><?=$sort->link('name',__('app','Name'))?></th>
			<th><?=$sort->link('reason',__('app','Reason'))?></th>
			<th><?=$sort->link('game',__('app','Game Name'))?></th>
			<th><?=$sort->link('date',__('app','Date'))?></th>
			<th><?=$sort->link('bannedby',__('app','Banned By'))?></th>
		</tr>
	</thead>
	<tbody>
		<?php if($bansCount < 1):?>
			<tr>
				<td class="noEntries" colspan="6">
					<?= __('app', 'No Bans found'); ?>
				</td>
			</tr>
		<?endif;?>
		<?php foreach($bans as $ban): ?>
			<?php
				$dateFormat = param('dateFormat');
				$reason = $ban['reason']; if(strlen($reason)>=40) {$reason = "".strtolower(substr($reason,0,40))."...";}
				$date = date($dateFormat,strtotime($ban['date']) );
			?>
			<tr>
				<td>
					<?=$ban['id']?>
				</td>
				<td>
					<?=CHtml::link($ban['name'],array('players/view','id'=>$ban['name']))?>
				</td>
				<td>
					<?=$reason?>
				</td>
				<td>
					<?=$ban['gamename']?>
				</td>
				<td >
					<?=$date?>
				</td>
				<td >
					<?=CHtml::link($ban['admin'],array('players/view','id'=>$ban['admin']))?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
<?php /* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */ ?>
