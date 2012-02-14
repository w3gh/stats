<?php
$this->breadcrumbs=array(
	__('app','Items'),
);

$this->menu=array(
	array('label'=>'Create Items', 'url'=>array('create')),
	array('label'=>'Manage Items', 'url'=>array('admin')),
);
$this->pageTitle=$this->title=__('app','Items');
?>

<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
<table id="items" class="list zebra-stripped">
	<thead>
		<tr>
			<th><?=$sort->link('name', __('app','Item'));?></th>
		</tr>
	</thead>
	<tbody>

		<?php if($itemsCount < 1):?>
			<tr>
				<td class="noEntries" colspan="2">
					<?=__('app','No Items found')?>
				</td>
			</tr>
		<?php endif;?>

		<?php
			foreach($items as $item):
				$itemName = CHTML::encode($item->shortname);
				$icon = $item->icon;
				$itemID = $item->itemid;
				$itemSummary = $item->item_info;
				$itemSummary = str_replace("\n\n", "<br>", $itemSummary);
				$itemSummary = str_replace("\n", "<br>", $itemSummary);
				$itemSummary = str_replace("Cost:", "<img alt='' title='Cost' style='vertical-align:middle;' border='0' src='".$this->assetsUrl."/img/coin.gif'>", $itemSummary);

		?>

		<tr>
			 <td>

					<div class="label item">
						<a class="item-name" rel="popover" title="" href='<?=$this->createUrl('view',array('id'=>$itemID))?>'>
							<img width='32' height='32' src='<?=$this->assetsUrl?>/img/items/<?=$icon?>'>
							<?=$itemName?>
							<div style="display:none"><?=$itemSummary?></div>
						</a>
					</div>

			 </td>
		</tr>

		<?php endforeach;?>
	</tbody>
</table>
<?php $this->widget('LinkPager', array('pages' => $pages)); ?>
<?php /*$this->widget('zii.widgets.CListView',
array(
				'dataProvider' => $dataProvider,
				'itemView' => '_view',
				//'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}",
				'pager' => array(
					'class'=>'LinkPager',
				),
			 ));*/ ?>
