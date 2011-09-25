<?php

/**
 *
 */
class HeroMostUsedItems extends Portlet
{
	public $heroId='';

	public $limit=2;

	protected function getHeroItems($itemModifier = '1', $excludedItems = array())
	{
		$queryArray = array();
		$queryArray['select'] =
			"count(*) AS total,
			dotaplayers.item$itemModifier AS item,
			items.icon AS icon,
			items.name AS name,
			items.itemid AS itemid";
		
		$queryArray['from'] = 'dotaplayers';
		$queryArray['join'] = "LEFT JOIN items ON items.itemid = dotaplayers.item$itemModifier";
		$queryArray['where'] = " hero = '{$this->heroId}'
			AND dotaplayers.item$itemModifier != '' \n";//AND dotaplayers.item != '\0\0\0\0'

		foreach($excludedItems as $excludedItem)
			$queryArray['where'] .= "AND dotaplayers.item$itemModifier != '$excludedItem' \n";

		$queryArray['group'] = "item$itemModifier";
		$queryArray['having'] = "COUNT(*) > 1";
		$queryArray['order'] = " COUNT(*) DESC";
		$queryArray['limit'] = "$this->limit";//":limit";
		
		$command = app()->db->createCommand();
		$query = $command->buildQuery($queryArray);
		$command = app()->db->getCommandBuilder()->createSqlCommand($query);

		return $command->queryAll();
	}

	public function getHeroMostUsedItems()
	{
		$excludedItems = array();
		$returnItems = array();
		
		for($i=1;$i < 7;++$i)
		{
			$items = $this->getHeroItems($i,$excludedItems);
			foreach($items as $item)
			{
				$returnItems[]=array(
					'itemid'=>$item['itemid'],
					'name'=>CHtml::encode($item['name']),
					'icon'=>$item['icon'],
					'total'=>$item['total']
				);

				$excludedItems[]= $item['item'];
			}
		}
		return $returnItems;
	}

	public function renderContent()
	{
		$items = $this->getHeroMostUsedItems();
		return $this->render('heroMostUsedItems',array(
			                                 'items'=>$items,
			                                 'itemsCount'=>count($items),
		                                  ));
	}
}