<?php $this->widget('zii.widgets.CListView', array(
  'id'=>'Servers-list-grid',
  'itemsCssClass'=>'items grid_16',
	'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
)); ?>
