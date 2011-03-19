<?php /* source file: /home/jilizart/www/Yii/html/protected/views/post/index.php */ ?>
<?php if(!empty($_GET['tag'])): ?>
  <div class="grid_16"><h4>Posts Tagged with <i><?php echo CHtml::encode($_GET['tag']); ?></i></h4></div>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
  'pager'=>array(
    'cssFile'=>false,
  ),
)); ?>
