<?php


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bans-grid', {
		data: $(this).serialize()
	});
	return false;
});

 $('.button-column a.view').click(function(){
  var link = $(this);
  $.get(link.attr('href'),function(data){

    var dialog = $('#dialog-wrapper');
    dialog.hide().html(data);

    dialog.dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( 'close' );
        }
      }
    });

  });
  return false;
 });

$('.button-column a.update').click(function(){
  var link = $(this);
  $.get(link.attr('href'),function(data){

    var dialog = $('#dialog-wrapper');
    dialog.html('');
    dialog.hide().html(data);

    dialog.dialog({
      modal: true,
      width: 600,
      buttons: {
        Ok: function() {
          $( this ).dialog( 'close' );
        }
      }
    });

  });
  return false;
 }); 
");
?>
<script type="text/javascript">


</script>

<div id="dialog-wrapper"></div>
<h1>Manage Bans</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bans-grid',
	'dataProvider'=>$model->search(),
  'cssFile'=>false,
	'filter'=>$model,
	'columns'=>array(
		'id',
		'botid',
		'server',
		'name',
		'ip',
		'date',
		/*
		'gamename',
		'admin',
		'reason',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
