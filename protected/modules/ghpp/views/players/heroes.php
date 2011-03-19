<?php
/* 
 * players heroes template file
 *
 * @author Nikolay Kosturin <jilizart@gmail.com>
 * @link http://w3gh.ru
 * @copyright Copyright &copy; 2010-2012 Nikolay Kosturin
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

foreach($servers as $id =>$s)
  $servernames[$s->serverid] = $s->servername;

$this->pageTitle=$name.' '.Yii::t('ghppModule.players', 'Heroes');

$this->breadcrumbs->mergeWith(array(
  Yii::t('ghppModule.players' ,'Players')=>array('index'),
  $servernames[$server]=>array('index', 'server'=>$server),
  $name=>array('players/player', 'name'=>$name, 'server'=>$server),
  Yii::t('ghppModule.players' ,'Heroes'),
));

$this->tabs->copyFrom(array(
  array('label'=>'List Players', 'url'=>array('players/index')),
  array('label'=>'Player', 'url'=>array('players/player','name'=>$name, 'server'=>$server)),
  array('label'=>'History', 'url'=>array('index')),
  array('label'=>'Items', 'url'=>array('index')),
  array('label'=>'Achiv\'s', 'url'=>array('index')),
));

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
  'id'=>'Heroes-list-grid',
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
      'id'=>'playerhero-totalgames',
      'header'=>Yii::t('ghppModule.players', 'Games'),
      'name'=>'totgames',
    ),
    array(
      'id'=>'playerhero-wins',
      'header'=>Yii::t('ghppModule.players', 'Wins'),
      'name'=>'win',
    ),
    array(
      'id'=>'playerhero-loss',
      'header'=>Yii::t('ghppModule.players', 'Losses'),
      'name'=>'loss',
    ),
    array(
      'id'=>'playerhero-kills',
      'header'=>Yii::t('ghppModule.players', 'Kills'),
      'name'=>'kills',
    ),
    array(
      'id'=>'playerhero-deaths',
      'header'=>Yii::t('ghppModule.players', 'Deaths'),
      'name'=>'deaths',
    ),
    array(
      'id'=>'playerhero-assists',
      'header'=>Yii::t('ghppModule.players', 'Assists'),
      'name'=>'assists',
    ),
    array(
      'id'=>'playerhero-creeps',
      'header'=>Yii::t('ghppModule.players', 'Creeps'),
      'name'=>'creepkills',
    ),
    array(
      'id'=>'playerhero-denies',
      'header'=>Yii::t('ghppModule.players', 'Denies'),
      'name'=>'creepdenies',
    ),
    array(
      'id'=>'playerhero-neutral',
      'header'=>Yii::t('ghppModule.players', 'Neutrals'),
      'name'=>'neutralkills',
    ),
    array(
      'id'=>'playerhero-towers',
      'header'=>Yii::t('ghppModule.players', 'Towers'),
      'name'=>'towerkills',
    ),
  )
  ));  ?>
