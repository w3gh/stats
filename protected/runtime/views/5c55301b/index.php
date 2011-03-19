<?php /* source file: /home/jilizart/www/Yii/html/protected/modules/ghpp/views/servers/index.php */ ?>
<?php

?>

<h4>Servers</h4>

<?php $this->widget('zii.widgets.CListView', array(
  'id'=>'Servers-list-grid',
  'itemsCssClass'=>'items grid_16',
	'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
)); ?>
