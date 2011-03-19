<?php /* source file: /home/jilizart/www/Yii/apps/w3ghstats/protected/modules/ghpp/views/admins/index.php */ ?>
<div class="grid_16"><h4>List of all Admins for all Servers</h4></div>

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
