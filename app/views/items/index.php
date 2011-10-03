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
			<th><?=$sort->link('item', __('app','Item'));?></th>
			<th><?=$sort->link('name', __('app','Name'));?></th>
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
				 <a href='<?=$this->createUrl('items/view',array('id'=>$itemID))?>'>
					<img border=0 width='48' height='48' src='<?=$this->assetsUrl?>/img/items/<?=$icon?>'>
				 </a>
			 </td>

			 <td >
				 <a onClick='showhide("<?=$itemID?>");' href='javascript:;'><?=$itemName?></a>
				 <div style='display:none;' id = '<?=$itemID?>'>
					 <?=$itemSummary?>
					 <br>
					 <?=CHtml::link('More info...', array('view','id'=>$itemID));?>
					 <br><br>
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
