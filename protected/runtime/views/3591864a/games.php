<?php /* source file: /home/jilizart/www/Yii/html/protected/modules/ghpp/views/players/games.php */ ?>
<?php
/* 
 * games template file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://w3gh.ru
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

foreach($servers as $id =>$s)
  $servernames[$s->serverid] = $s->servername;

$this->pageTitle=$name.' '.Yii::t('ghppModule.players', 'Games');

$this->breadcrumbs->mergeWith(array(
  Yii::t('ghppModule.players' ,'Players')=>array('index'),
  $servernames[$server]=>array('index', 'server'=>$server),
  $name=>array('players/player', 'name'=>$name, 'server'=>$server),
  Yii::t('ghppModule.players' ,'Games'),
));

$this->tabs->copyFrom(array(
  array('label'=>'List Players', 'url'=>array('players/index')),
  array('label'=>'Heroes', 'url'=>array('players/heroes','name'=>$name,'server'=>$server)),
  array('label'=>'Player', 'url'=>array('players/player','name'=>$name,'server'=>$server)),
  array('label'=>'Items', 'url'=>array('index')),
  array('label'=>'Achiv\'s', 'url'=>array('index')),
));

?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
  'id'=>'Games-list-grid',
	'dataProvider'=>$dataProvider,
  'cssFile'=>false,
   'pager'=>array(
       'cssFile'=>false,
   ),
  'columns'=>array(
    array(
      'id'=>'playerhero',
      'header'=>Yii::t('ghppModule.players', 'Hero Name'),
      'name'=>'hero',
      'htmlOptions'=>array('class'=>'playerhero'),
      'type'=>'raw',
      'value'=>'CHtml::link( CHtml::image("'.$this->moduleAssetsPath.'/images/heroes/".strtoupper( ($data->herooriginal) ? $data->herooriginal : $data->hero).".gif", CHtml::encode($data->heroname), array("width"=>"24", "heigt"=>"24") ).CHtml::tag("span", array("class"=>"heroname"), $data->heroname), array("heroes", "name"=>($data->herooriginal) ? $data->herooriginal : $data->hero), array("class"=>"clearfix") )'
    ),
    array(
      'id'=>'gamename',
      'header'=>Yii::t('ghppModule.games', 'Game Name'),
      'name'=>'gamename',
      'type'=>'raw',
      'cssClassExpression'=>'GHtml::gameType($data)." ".GHtml::gameWinner($data)',
      'value'=>'CHtml::link($data->gamename, array("games/view", "id"=>$data->id), array("title"=>GHtml::normalizeMapName($data)));',
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
  )); ?>