<?php

/**
 * LastGamesWithItem Portlet displays last games where item used
 *
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 * @version $Id: $
 * @package app.components.widgets
 */
class LastGamesWithItem extends Portlet
{
	public $itemId='';

	public $limit=5;
	
	public $itemShortName='';

	public function getLastGamesWithItem() {
		$commandBuilder = app()->db->getCommandBuilder();
		
		$sql = "
			SELECT
				dp.item1,
				dp.item2,
				dp.item3,
				dp.item4,
				dp.item5,
				dp.item6,
				dp.gameid AS gid,
				g.id,
				g.datetime AS datetime,
				g.gamename AS gname,
				g.duration AS duration,
				g.creatorname AS creator,
				dg.winner as winner
			FROM dotaplayers AS dp
			LEFT JOIN games AS g ON g.id = dp.gameid
			LEFT JOIN dotagames AS dg ON dg.gameid = g.id
			WHERE dp.item1 = :itemid
				OR dp.item2 = :itemid
				OR dp.item3 = :itemid
				OR dp.item4 = :itemid
				OR dp.item5 = :itemid
				OR dp.item6 = :itemid
			ORDER BY g.datetime DESC LIMIT :limit";
		$command = $commandBuilder->createSqlCommand($sql,array(
			                                               ':itemid'=>$this->itemId,
			                                               ':limit'=>$this->limit,
		                                                 ));

		return $command->queryAll();
	}

	public function renderContent() {
		return $this->render('lastGamesWithItem');
	}
}
