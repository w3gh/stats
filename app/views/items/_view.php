<?php

$itemName = CHTML::encode($data->shortname);
$icon = $data->icon;
$itemID = $data->itemid;
$itemSummary = $data->item_info;
$itemSummary = str_replace("\n\n", "<br>", $itemSummary);
$itemSummary = str_replace("\n", "<br>", $itemSummary);
$itemSummary = str_replace("Cost:", "<img alt='' title='Cost' style='vertical-align:middle;' border='0' src='".$this->assetsUrl."/img/coin.gif'>", $itemSummary);

?>

<tr>
	 <td valign='top' class='padLeft' width='52' align='left'>
		 <a href='<?=$this->createUrl('items/view',array('id'=>$itemID))?>'>
		  <img border=0 width='48' height='48' src='<?=$this->assetsUrl?>/img/items/<?=$icon?>'>
		 </a>
	 </td>

	 <td class='padLeft' align='left'>
		 <a onClick='showhide("<?=$itemID?>");' href='javascript:;'><?=$itemName?></a>
		 <div style='display:none;' id = '<?=$itemID?>'>
			 <?=$itemSummary?>
			 <br>
			 <?=CHtml::link('More info...', array('view','id'=>$itemID));?>
			 <br><br>
			</div>
	</td>
</tr>