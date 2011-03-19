<?php /* source file: /home/jilizart/www/Yii/html/protected/modules/ghpp/views/servers/_view.php */ ?>
<div class="server-view">
  <div class="logo">&nbsp;</div>
  <div class="description">
    Server Description
  </div>
  <div class="bots">
    <ul class="bot-list">
      <?php foreach (array('Bot1', 'Bot2', 'Bot3', 'Bot4') as $value):?>
      <li class="status-online"><?php echo $value ?></li>
      <?php endforeach;?>
    </ul>
  </div>
  <div class="misc">
    <dl>
      <dt><?php echo CHtml::encode($data->name); ?></dt>
      <dd><?php echo CHtml::encode($data->server); ?> <?php echo CHtml::encode($data->port); ?></dd>
    </dl>
    <ul>
      <li><a href="#">Admins</a></li>
      <li><a href="#">Bans</a></li>
      <li><a href="#">Players</a></li>
      <li><a href="#">Games</a></li>
    </ul>
  </div>

  <div class="clear"></div>
</div>