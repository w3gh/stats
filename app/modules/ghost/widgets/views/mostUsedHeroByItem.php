<div align='center'>
	<table class='tableHeroPageTop'>
		<thead>
		<tr>
			<th>
				<div align='center'><?=__('app','Most used by:')?> </div>
			</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td align='center' width='64' class='padLeft'>
				<?php	foreach($this->getMostUsedHeroByItem() as $row):

					$hero = strtoupper($row['hero']);
					$heroName = CHTML::encode($row['heroname']);
					$itemName = CHTML::encode($this->itemName);
					$itemShortName = CHTML::encode($this->itemShortName);
					$totals = $row['total'];
					/*"<b><?=$this->heroName?></b> used <br><?=$itemShortName?><br><b><?=$totals?> x</b>"*/
					$image = CHtml::image($this->owner->assetsUrl.'/img/heroes/'.$hero.'.gif',
					                      $heroName,
					                      array('width'=>48,'height'=>48));

					echo CHtml::link($image,array('heroes/view','id'=>$hero));
					?>

				<?php endforeach; ?>
			</td>
		</tr>
		</tbody>
	</table>
</div>
<br>