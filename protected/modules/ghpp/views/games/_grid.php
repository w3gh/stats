<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
  'cssFile'=>false,
  'columns'=>array(
    array(
      'id'=>'gamename',
      'header'=>Yii::t('ghppModule.games', 'Game Name'),
      'name'=>'gamename',
      'type'=>'raw',
      'cssClassExpression'=>'GHtml::gameType($data)." ".GHtml::gameWinner($data)',
      'value'=>'CHtml::link($data->gamename, array("view", "id"=>$data->id), array("title"=>GHtml::normalizeMapName($data)));',
    ),
    array(
      'id'=>'duration',
      'header'=>Yii::t('ghppModule.games', 'Duration'),
      'name'=>'duration',
      'type'=>'raw',
      'value'=>'GHtml::secondsToTime($data->duration)',
    ),
    array(
      'id'=>'datetime',
      'header'=>Yii::t('ghppModule.games', 'Date'),
      'name'=>'datetime',
      'type'=>'raw',
      'value'=>'$data->date',
    ),
    array(
       'id'=>'ownername',
       'header'=>Yii::t('ghppModule.games', 'Owner Name'),
       'name'=>'ownername',
       'type'=>'raw',
       'value'=>'CHtml::link(GHtml::playerStatus($data), array("players/player","name"=>$data->name, "server"=>$data->serverid));',
    ),
    array(
      'id'=>'boid',
      'header'=>Yii::t('ghppModule.games', 'Bot'),
      'name'=>'botid',
      'type'=>'raw',
      'value'=>'CHtml::link($data->boname, array("bots/view","id"=>$data->boid));',
    ),
    array(
      'id'=>'creatorserver',
      'header'=>Yii::t('ghppModule.games', 'Server'),
      'name'=>'creatorserver',
      'type'=>'raw',
      'value'=>'CHtml::link($data->servername, array("servers/view","id"=>$data->serverid));',
    )
  ),
  'pager'=>array(
      'cssFile'=>false,
  ),
)); ?>