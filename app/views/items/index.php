<?php
$this->breadcrumbs=array(
	'Items',
);

$this->menu=array(
	array('label'=>'Create Items', 'url'=>array('create')),
	array('label'=>'Manage Items', 'url'=>array('admin')),
);
?>
<div style="clear: both;">&nbsp;</div>
<div align='center'>
	<table class='tableHeroPageTop'>
		<tr>
			<th>
				<div align='center'>Item</div>
			</th>
			<th class='padLeft'>Name</th>
		</tr>
		<?php $this->widget('zii.widgets.CListView',
		  array(
							'dataProvider' => $dataProvider,
							'itemView' => '_view',
			        //'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}",
							'pager' => array(
								'class'=>'LinkPager',
							),
		         )); ?>
	</table>
</div>
<div style="clear: both;">&nbsp;</div>