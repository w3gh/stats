<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
	array('label'=>'Update Items', 'url'=>array('update', 'id'=>$model->itemid)),
	array('label'=>'Delete Items', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->itemid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Items', 'url'=>array('admin')),
);

$itemId = $model->itemid;
$itemName = $model->name;
$itemShortName = $model->shortname;
$itemInfo = $model->item_info;
$itemInfo = str_replace("\n\n", "<br>", $itemInfo);
$itemInfo = str_replace("\n", "<br>", $itemInfo);
$itemInfo = str_replace("Cost:", "<img alt='' title='Cost' style='vertical-align:middle;' border='0' src='".$this->assetsUrl."/img/coin.gif'>", $itemInfo);
$itemIcon = $model->icon;

$this->pageTitle = $itemShortName;

?>


<table class='list zebra-striped'>
<tr>
   <th><?=$itemShortName?> information</th>
</tr>
<tr>
    <td>


    <table class='tableItem'>
    <tr>
                    <td align='left' class='ItemInfo'>
                        <img border='0' style='vertical-align:middle;' alt='<?=$itemShortName?>' title='' src='<?=$this->assetsUrl?>/img/items/<?=$itemIcon?>'> <b><?=$itemShortName?></b><br>
                        <?=$itemInfo?>
                    </td>
        </tr>
    </table>


     </td>
</tr>
</table>

<?php if(param('showItemsMostUsedByHero')) $this->widget('MostUsedHeroByItem',array(
	'heroId'=>'',
	'itemId'=>$itemId,
	'itemName'=>$itemName,
	'itemShortName'=>$itemShortName,
	'limit'=>8,
                                                                       )); ?>

<?php $this->widget('LastGamesWithItem',array(
	'itemId'=>$itemId,
	'itemShortName'=>$itemShortName,
	'limit'=>5,
                                                                       )); ?>
<?php
  /*    if ($ShowItemsMostUsedByHero == 1) {
          $sql = getMostUsedHeroByItem("", $itemid, 8,$itemName );
          $result = $db->query($sql);
          if ($db->num_rows($result) >= 1) {
              ?><div align='center'>
			    <table class='tableHeroPageTop'>
				   <tr>
                        <th><div align='center'><?=$_lang["most_used"]?> </div></th>
                   </tr>
				   <tr>
					     <td align='center' width='64' class='padLeft'><?php
              while ($row = $db->fetch_array($result, 'assoc')) {
                  $hero = strtoupper($row["hero"]);
                  $heroName = convEnt2($row["heroname"]);
                  $itemName = convEnt2($itemName);
				  $itemShortName = convEnt2($itemShortName);
                  $totals = $row["total"];
          //if (!file_exists("./img/heroes/$hero.gif")) {$hero = ""; $heroName.=convEnt2(" ($row[heroid].gif)");}
          ?><a onMouseout='hidetooltip()' onMouseover='tooltip("<b><?=$heroName?></b> used <br><?=$itemShortName?><br><b><?=$totals?> x</b>",130)' href='hero.php?hero=<?=$hero?>'>
        <img width='48' height='48' border='0'
      src='./img/heroes/<?=$hero?>.gif'></a>
              <?php } ?>
                         </td>
					</tr>
			  </table>
		      </div>
		      <br><?php
          }
      }*/
?>

<?php /*
	  $sql = "SELECT
	  dp.item1 as item1,dp.item2 as item2,dp.item3,dp.item4,dp.item5,dp.item6,
	  dp.gameid as gid, g.id, g.datetime as datetime,
	  g.gamename as gname, g.duration as duration,g.creatorname as creator,
	  dg.winner as winner
	  FROM dotaplayers AS dp
	  LEFT JOIN games AS g ON g.id = dp.gameid
	  LEFT JOIN dotagames as dg ON dg.gameid = g.id
	  WHERE dp.item1 = '$itemid'
	  OR dp.item2 = '$itemid'
	  OR dp.item3 = '$itemid'
      OR dp.item4 = '$itemid'
      OR dp.item5 = '$itemid'
	  OR dp.item6 = '$itemid'
	  ORDER BY g.datetime DESC LIMIT 5
	  ";
	  $result = $db->query($sql);
	  if ($db->num_rows($result)>=1)
	  {
	  ?><div align="center">
	   <table class='tableHeroPageTop'><tr>
	   <th><div align='center'>Last 5 games with <?=$itemShortName?></div></th></tr>
	   <tr>
	      <td>
		      <table><tr>
	                  <th><?=$lang["game"]?></th>
					  <th><?=$lang["duration"]?></th>
					  <th><?=$lang["date"]?></th>
					  <th><?=$lang["creator"]?></th>
					  </tr>
	   <?php
	   while ($row = $db->fetch_array($result, 'assoc')) {
	   $date = date($date_format,strtotime($row["datetime"]));
	   $creator = strtolower($row["creator"]);
	   $gamename = $row["gname"];
	   $winner=$row["winner"];
	   if ($winner == 1) {$gamename = "<span class=\"GamesSentinel\">".$row["gname"]."</span>";}
	   if ($winner == 2) {$gamename = "<span class=\"GamesScourge\">".$row["gname"]."</span>";}
	   if ($winner == 0) {$gamename = "<span>".$row["gname"]."</span>";}
	   ?>
	   <tr class="row">
	     <td class="padAll"><a href='game.php?gameid=<?=$row["gid"]?>&item=<?=$itemid?>'><?=$gamename?></a></td>
	     <td class="padAll"><?=secondsToTime($row["duration"])?></td>
	     <td class="padAll"><?=$date?></td>
	     <td class="padAll"><a href="user.php?u=<?=$creator?>"><?=$row["creator"]?></a></td>
	   </tr>
	   <?php
	   }
	   ?> </td>
	        </table>

	   </tr>
	   </table>
	   </div>
	   <div style="clear: both;">&nbsp;</div><?php
       } */ ?>
