<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'admins-grid',
    'dataProvider'=>$dataProvider,
    'cssFile'=>false,
    'columns'=>array(
       array(
           'id'=>'playername',
           'header'=>'Player Name',
           'name'=>'name',
           'headerHtmlOptions'=>array(),
           'type'=>'raw',
           'value'=>'CHtml::link($data->name, array("players/player","name"=>$data->name, "server"=>$data->serverid));',
       ),
       array(
           'id'=>'gameshosted',
           'header'=>'Games',
           'name'=>'gameshosted',
           'headerHtmlOptions'=>array(),
       ),
       array(
           'id'=>'banscount',
           'header'=>'Bans',
           'name'=>'banscount',
           'headerHtmlOptions'=>array(),
           'type'=>'raw',
           'value'=>'CHtml::link($data->banscount, array("admins/bansby","name"=>$data->name, "server"=>$data->serverid));',
       ),
      array(
            'id'=>'server',
            'name'=>'servername',
            'header'=>'Server',
            'headerHtmlOptions'=>array(),
      ),
      array(
            'id'=>'bot',
            'name'=>'boname',
            'header'=>'Bot',
            'headerHtmlOptions'=>array(),
      ),
   ),
   'pager'=>array(
      'cssFile'=>false,
    ),
)); ?>