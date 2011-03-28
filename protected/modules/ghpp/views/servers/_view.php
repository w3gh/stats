<div class="server-view">
  <h4><?php echo CHtml::encode($data->name); ?></h4>
      <em><?php echo CHtml::encode($data->server); ?> <?php echo CHtml::encode($data->port); ?></em>
<!--  <div class="logo">&nbsp;</div>
  <div class="description">
    Server Description
  </div>-->
  <div class="misc">

 <?php $this->widget('zii.widgets.jui.CJuiTabs', array(
    'cssFile'=>false,
    'tabs'=>array(
        'StaticTab 1'=>'Content for tab 1',
        'StaticTab 2'=>'Content for tab 2',
    ),
     'options'=>array(
         'collapsible'=>true,
     ),
 )); ?>

  <div class="bots">
    <ul class="bot-list">
      <?php foreach (array('Bot1', 'Bot2', 'Bot3', 'Bot4') as $value):?>
      <li class="status-online"><?php echo $value ?></li>
      <?php endforeach;?>
    </ul>
  </div>

    <ul>
      <li><a href="#">Admins</a></li>
      <li><a href="#">Bans</a></li>
      <li><a href="#">Players</a></li>
      <li><a href="#">Games</a></li>
    </ul>
  </div>

  <div class="clear"></div>
</div>