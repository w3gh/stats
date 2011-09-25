<?php


class MostUsedHeroByItem extends Portlet
{
	public $heroId;

	public $itemId;

	public $itemName;

	public $heroName;

	public $itemShortName;
	
	public $limit;

	public function getMostUsedHeroByItem()
	{
		$itemName = $this->itemName;

		$commandBuilder = app()->db->getCommandBuilder();
		
		if (
			  !strstr($itemName,"Aghanim")
		AND !strstr($itemName,"Armlet of Mordiggian")
		AND !strstr($itemName,"Black King Bar")
		AND !strstr($itemName,"Dagon Lev")
		AND !strstr($itemName,"Diffusal Blade")
		AND !strstr($itemName,"Divine Rapier")
		AND !strstr($itemName,"Bottle")
		AND !strstr($itemName,"Linken")
		AND !strstr($itemName,"Power Treads")
		AND !strstr($itemName,"Monkey King Bar")
		AND !strstr($itemName,"Eye of Skadi")
		AND !strstr($itemName,"Orb of Venom")
		AND !strstr($itemName,"Necronomicon Lev")
		AND !strstr($itemName,"Urn of Shadows")
		AND !strstr($itemName,"Dust of Appearance")
		AND !strstr($itemName,"s Dagger")
		AND !strstr($itemName,"Heart of Tarrasque")
		AND !strstr($itemName,"Radiance")
		)
		{
			$sql = "
			SELECT
				COUNT(*) AS total,
				dp.item1,
				dp.item2,
				dp.item3,
				dp.item4,
				dp.item5,
				dp.item6,
				dp.hero,
				h.heroid,
				h.description AS heroname
			FROM dotaplayers AS dp
			LEFT JOIN heroes AS h ON h.original = dp.hero AND h.summary != '-'
			WHERE dp.hero = :heroId AND dp.hero !=''
				OR dp.item1 = :itemId
				OR dp.item2 = :itemId
				OR dp.item3 = :itemId
				OR dp.item4 = :itemId
				OR dp.item5 = :itemId
				OR dp.item6 = :itemId
			GROUP BY dp.hero
			ORDER BY COUNT(*) DESC
			LIMIT :limit";
			
			$command = $commandBuilder->createSqlCommand($sql);
			$command->bindValues(array(
														':heroId'=>$this->heroId,
														':itemId'=>$this->itemId,
			                     ));
	
		} else {
			if (strstr($itemName,"Aghanim"))           $itemName = "Aghanim";
			if (strstr($itemName,"Black King Bar"))    $itemName = "Black King Bar";
			if (strstr($itemName,"Dagon"))             $itemName = "Dagon";
			if (strstr($itemName,"Diffusal Blade"))    $itemName = "Diffusal Blade";
			if (strstr($itemName,"Divine Rapier"))     $itemName = "Divine Rapier";
			if (strstr($itemName,"Bottle"))            $itemName = "Bottle";
			if (strstr($itemName,"Linken"))            $itemName = "Linken";
			if (strstr($itemName,"Power Treads"))      $itemName = "Power Treads";
			if (strstr($itemName,"Monkey King Bar"))   $itemName = "Monkey King Bar";
			if (strstr($itemName,"Eye of Skadi"))      $itemName = "Eye of Skadi";
			if (strstr($itemName,"Orb of Venom"))      $itemName = "Orb of Venom";
			if (strstr($itemName,"Necronomicon Lev"))  $itemName = "Necronomicon Lev";
			if (strstr($itemName,"Urn of Shadows"))    $itemName = "Urn of Shadows";
			if (strstr($itemName,"Dust of Appearance"))   $itemName = "Dust of Appearance";
			if (strstr($itemName,"s Dagger"))             $itemName = "s Dagger";
			if (strstr($itemName,"Armlet of Mordiggian")) $itemName = "Armlet of Mordiggian";
			if (strstr($itemName,"Heart of Tarrasque"))   $itemName = "Heart of Tarrasque";
			if (strstr($itemName,"Radiance"))          $itemName = "Radiance";

			$sql = "
			SELECT
				COUNT(*) AS total,
				dp.item1,
				dp.item2,
				dp.item3,
				dp.item4,
				dp.item5,
				dp.item6,
				dp.hero,
				h.heroid,
				h.description AS heroname,
				it.name,
				it.itemid
			FROM dotaplayers AS dp
			LEFT JOIN heroes AS h ON h.original = dp.hero AND h.summary != '-'
			LEFT JOIN items AS it  ON it.name  LIKE ('%$itemName%') AND  it.item_info!=''  AND (it.itemid = dp.item1)
			LEFT JOIN items AS it2 ON it2.name LIKE ('%$itemName%') AND  it2.item_info!='' AND (it2.itemid = dp.item2)
			LEFT JOIN items AS it3 ON it3.name LIKE ('%$itemName%') AND  it3.item_info!='' AND (it3.itemid = dp.item3)
			LEFT JOIN items AS it4 ON it4.name LIKE ('%$itemName%') AND  it4.item_info!='' AND (it4.itemid = dp.item4)
			LEFT JOIN items AS it5 ON it5.name LIKE ('%$itemName%') AND  it5.item_info!='' AND (it5.itemid = dp.item5)
			LEFT JOIN items AS it6 ON it6.name LIKE ('%$itemName%') AND  it6.item_info!='' AND (it6.itemid = dp.item6)
			WHERE dp.hero = :heroId AND dp.hero !=''
				OR it.name LIKE ('%$itemName%') OR it2.name LIKE ('%$itemName%') OR it3.name LIKE ('%$itemName%')
				OR it4.name LIKE ('%$itemName%') OR it5.name LIKE ('%$itemName%') OR it6.name LIKE ('%$itemName%')
			GROUP BY dp.hero
			ORDER BY COUNT(*) DESC,  dp.hero DESC
			LIMIT :limit";

			$itemNameValue = "'%$itemName%'"; // little hack
			$command = $commandBuilder->createSqlCommand($sql);
			$command->bindValues(array(
				                     //':itemName'=>$itemNameValue,
				                     ':heroId'=>$this->heroId,
			                     ));

	  }

		$command->bindValue(':limit',$this->limit,PDO::PARAM_INT);
		return $command->queryAll();
	}

	protected function renderContent()
	{
		$this->render('mostUsedHeroByItem');
	}
}
