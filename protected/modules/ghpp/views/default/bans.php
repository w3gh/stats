<?php

/*@var $this CController */

?>


<?php $this->widget('CLinkPager', array(
  'pages'=>$pages,
)); ?>
<div class="tabs">
  <?php foreach($servers as $sid => $sname):?>
  <li>
    <?php echo CHtml::link($sname, $this->createUrl('bans', array('server'=>$sid))) ?>
    <ul>
      <?php foreach($bots[$sid] as $bid => $bname):?>
      <li><?php echo CHtml::link($bname, $this->createUrl('bans', array('server'=>$sid, 'bot'=>$bid))) ?></li>
      <?php endforeach; ?>
    </ul>
  </li>
  <?php endforeach; ?>
  <?php Yii::trace(var_export(array($servers,$bots), true)); ?>
</div>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Reason</th>
      <th>Game Name</th>
      <th>Date</th>
      <th>Expire Date</th>
      <th>Banned by</th>
    </tr>
  </thead>
  <tbody>


<?php foreach($rows as $serverid => $server):?>
  
  <?php if(($server['name']) && ($server['id'])):?><tr><td colspan="6"><?php  print CHtml::link($server['name'], $this->createUrl('bans', array('server'=>$server['id']))) ?></td></tr><?php endif; ?>

  <?php foreach($server['bots'] as $botid => $bot): ?>

    <?php if(($bot['name']) && ($bot['id'])):?><tr><td colspan="6"><?php print CHtml::link($bot['name'], $this->createUrl('bans', array('server'=>$server['id'], 'bot'=>$bot['id']))) ?> Bot</td></tr><?php endif; ?>

    <?php foreach($bot['bans'] as $banid => $ban):?>
      <tr>
        <td><?php print $ban['name'] ?></td>
        <td><?php print $ban['reason'] ?></td>
        <td><?php print $ban['gamename'] ?></td>
        <td><?php print $ban['day'] ?>.<?php print $ban['month'] ?>.<?php print $ban['year'] ?></td>
        <td><?php print $ban['day'] ?>.<?php print $ban['month'] ?>.<?php print $ban['year'] ?></td>
        <td><?php print $ban['admin'] ?></td>
      </tr>
     <?php endforeach; ?>

  <?php endforeach; ?>

<?php endforeach; ?>

     
    <?php /*
          'name' => string 'kyrag_19' (length=8)
          'server' => string '90.189.192.212' (length=14)
          'ip' => string '95.188.189.166' (length=14)
          'year' => string '2010' (length=4)
          'month' => string '8' (length=1)
          'day' => string '29' (length=2)
          'gamename' => string 'xaoc[gg10]' (length=10)
          'admin' => string 'xaoc' (length=4)
          'servername' => string 'Sibnet Realm' (length=12)
          'serverid' => string '2' (length=1)
          'botid' => string '1' (length=1)
          'reason' => string 'leaver gavno' (length=12)
    */?>
    
  </tbody>
</table>

<?php $this->widget('CLinkPager', array(
  'pages'=>$pages,
));  ?>