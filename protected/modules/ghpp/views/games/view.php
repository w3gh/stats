<?php
$scourge=true;
$sentinel=true;
$winner=0;
$bestplayer=array('name'=>'', 'kills'=>0);
?>

<div class="gamestat">
  <div class="grid_3 gamename"><%= Yii::t('ghppModule.game', 'Game: <b>{game}</b>', array('{game}'=>$model->gamename)); %></div>
  <div class="grid_3 datetime"><%= Yii::t('ghppModule.game', 'Date: <b>{date}</b>', array('{date}'=>$model->date)); %></div>
  <div class="grid_3 creatorname"><%= Yii::t('ghppModule.game', 'Creator: <b>{creator}</b>', array('{creator}'=>$model->creatorname)); %></div>
  <div class="grid_3 duration"><%= Yii::t('ghppModule.game', 'Duration: <b>{duration}</b>', array('{duration}'=>GHtml::secondsToTime($model->duration))); %></div>
  <div class="grid_4 servername"><%= Yii::t('ghppModule.game', 'On Server: <b>{server}</b>', array('{server}'=>$model->servername)); %></div>
  <div class="clear"></div>
</div>
<table class="gamestat-table">
  <thead>
    <tr>
      <th>Player</th>
      <th>Hero</th>
      <th>Kills</th>
      <th>Deaths</th>
      <th>Assists</th>
      <th>Creeps</th>
      <th>Denies</th>
      <th>Neutrals</th>
      <th>Towers</th>
      <th>Gold</th>
      <th>Items</th>
      <th>Server</th>
      <th>Left at</th>
      <th>Reason</th>
    </tr>
  </thead>
  <tbody>
    <?php while($player = array_shift($game)): ?>
    <?php if($player->kills >= $bestplayer['kills']) { $bestplayer['name']=$player->name; $bestplayer['kills']=$player->kills; } ?>
    <?php if($player->newcolour<=5 && $sentinel): $sentinel=false; $winner=$player->winner; ?><tr><td class="sentinelRow" colspan="14">Sentinel</td></tr><?php endif; ?>
    <?php if ($player->newcolour>5 && $player->newcolour<11 && $scourge): $scourge=false; ?><tr><td class="scourgeRow" colspan="14">Scourge</td></tr><?php endif; ?>
    <tr>
      <td class="playername"><?php print CHtml::link(GHtml::playerStatus($player, array('class'=>GHtml::getColor($player->newcolour))), array("players/player", "name"=>$player->name)); ?></td>
      <td class="playerhero"><?php print
      CHtml::link( 
        CHtml::image(
          "$this->moduleAssetsPath/images/heroes/".strtoupper( ($player->herooriginal) ? $player->herooriginal : $player->hero).".gif",
          CHtml::encode($player->heroname), array("width"=>"24", "heigt"=>"24")
          ),
          //CHtml::tag("span", array("class"=>"heroname"), $player->heroname),
        array("heroes", "name"=>($player->herooriginal) ? $player->herooriginal : $player->hero),
        array("class"=>"clearfix") ); ?></td>
      <td class="playerkills"><?php print $player->kills ?></td>
      <td class="playerdeaths"><?php print $player->deaths ?></td>
      <td class="playerassists"><?php print $player->assists ?></td>
      <td class="creepkills"><?php print $player->creepkills ?></td>
      <td class="creepdenies"><?php print $player->creepdenies ?></td>
      <td class="neutralkills"><?php print $player->neutralkills ?></td>
      <td class="towerkills"><?php print $player->towerkills ?></td>
      <td class="gold"><?php print $player->gold ?></td>
      <td class="items"><?php /*print $player->item1 ?> <?php print $player->item2 ?> <?php print $player->item3 ?> <?php print $player->item4 */ ?></td>
      <td class="server"><?php print $player->servername ?></td>
      <td class="leftat"><?php print GHtml::secondsToTime($player->left) ?></td>
      <td class="leftreason"><?php print $player->leftreason ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<div class="clear"></div>
<div class="gameresult">
  <div class="grid_4 bestplayer"><?php print Yii::t('ghppModule.game', 'Best Player: <b>{name}</b>', array('{name}'=>CHtml::link($bestplayer['name'], array("players/player", "name"=>$bestplayer['name']))))  ?></div>
  <div class="grid_8 scores">Sentinel <b>40</b>:<b>19</b> Scourge</div>
  <div class="grid_4 winner"> <span class="<?php print GHtml::gameWinner($winner) ?>Row"><?php print GHtml::gameWinner($winner); ?></span> Winner</div>
</div>
<?php /* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'botid',
		'server',
		'map',
		'datetime',
		'gamename',
		'ownername',
		'duration',
		'gamestate',
		'creatorname',
		'creatorserver',
	),
)); */ ?>
