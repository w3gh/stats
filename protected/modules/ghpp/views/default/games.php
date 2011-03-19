<?php
$this->breadcrumbs=array(
	'Games',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $players = Players::model()->findAll(
  array(
  'select'=>'*',
  //'condition'=>'gameid=:gameid',
  //'group'=>'gameid',
  'order'=>'gameid',
  'limit'=>50,
  'params'=>array(
    ':gameid'=>3123,
    )
  ));?>

<?php foreach($players as $player):?>
id:<?php print $player->gameid;?> ::
Player:<?php print $player->name;?>
<br/>
<?php endforeach;?>
<p>You may change the content of this page by modifying the file <tt><?php echo __FILE__; ?>.</p>
