<?php

?>

<h4>Bots</h4>

<?php $this->widget('zii.widgets.CListView', array(
  'id'=>'Bots-list-grid',
  'itemsCssClass'=>'items grid_16',
	'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
)); ?>
