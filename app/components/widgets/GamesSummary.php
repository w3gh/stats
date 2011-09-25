<?php


/**
 *
 */
class GamesSummary extends Portlet
{

	protected $gamesCount;

	/**
	 * Get Games Summary Result for every winner
	 * @return array
	 */
	protected function getGamesSummaryResult()
	{
		
		$commandBuilder = app()->db->getCommandBuilder();
		$sql = "
		SELECT
			SUM(kills) AS kills,
			SUM(deaths) AS deaths,
			SUM(creepkills) AS creepKills,
			SUM(creepdenies) AS creepDenies,
			SUM(towerkills) AS towerKills,
			SUM(raxkills) AS raxKills,
			SUM(courierkills) AS courierKills,
			SUM(assists) AS assists
		FROM dotaplayers
		LEFT JOIN dotagames ON dotagames.gameid = dotaplayers.gameid
		WHERE dotagames.winner = :winner AND  dotagames.winner != 0 LIMIT 1";

		$return=array();
		/*
		 * winner can be 0 Draw, 1 Sentinel, 2 Scourge
		 */
		$results = array(
			//'Draw'=>0,
			'sentinel'=>1,
			'scourge'=>2
		);
		foreach($results as $id=>$result)
		{
			$command = $commandBuilder->createSqlCommand($sql,array(':winner'=>$result));
			$row = $command->queryRow();
			$return[$id]=array(
				'totalKills' =>       number_format($row["kills"],"0",".",","),
				'totalDeaths' =>      number_format($row["deaths"],"0",".",","),
				'totalAssists' =>     number_format($row["assists"],"0",".",","),
				'totalCreepKills' =>  number_format($row["creepKills"],"0",".",","),
				'totalCreepDenies' => number_format($row["creepDenies"],"0",".",","),
				'totalTowers' =>      number_format($row["towerKills"],"0",".",","),
				'totalRax' =>         number_format($row["raxKills"],"0",".",","),
				'totalCourier' =>     number_format($row["courierKills"],"0",".",","),
			);

		}
		return $return;
	}

	public function getGamesCount()
	{
		$commandBuilder = app()->db->getCommandBuilder();
    $sql = "
			SELECT
				COUNT(*) AS total,
				SUM(CASE WHEN(dg.winner = 1) THEN 1 ELSE 0 END) AS sentinelWon,
				SUM(CASE WHEN(dg.winner = 2) THEN 1 ELSE 0 END) AS scourgeWon,
				SUM(CASE WHEN(dg.winner = 0) THEN 1 ELSE 0 END) AS draw
		  FROM dotagames AS dg
		  WHERE dg.winner = 1 OR dg.winner = 2 OR dg.winner = 0
		  LIMIT 1";
		$command = $commandBuilder->createSqlCommand($sql);
		$row = $command->queryRow();
		$this->gamesCount = $row['total'];
		return $row;
	}

	public function getGamesDuration()
	{
		$commandBuilder = app()->db->getCommandBuilder();
	  $sql = "
			SELECT
				MAX(duration) as maxDuration,
				MIN(duration) as minDuration,
				AVG(duration) as avgDuration,
				SUM(duration) as sumDuration
	  	FROM games
	  	WHERE LOWER(map) LIKE LOWER('%dota%')
	  	LIMIT 1";
		$command = $commandBuilder->createSqlCommand($sql);
	  $row = $command->queryRow();
		return array(
			'maxDuration'=>   Util::secondsToTime($row["maxDuration"]),
			'minDuration'=>   Util::secondsToTime($row["minDuration"]),
			'avgDuration'=>   Util::secondsToTime($row["avgDuration"]),
			'totalDuration'=> Util::secondsToTime($row["sumDuration"]),
			'totalGames' =>   number_format($this->gamesCount,"0",".",","),
		);
	}

	public function renderContent()
	{
		$data=array();

    $row = $this->getGamesCount();

		//how many dota games has been played?
    $data['totals'] = $row["sentinelWon"]+$row["scourgeWon"]+$row["draw"];

		//raw vars for some calculations
		$data['sentinelWonRaw'] = $row["sentinelWon"];
		$data['scourgeWonRaw'] =  $row["scourgeWon"];

		$data['draw'] =         number_format($row["draw"],"0",".",",");
    $data['sentinelWon'] =  number_format($row["sentinelWon"],"0",".",",");
    $data['scourgeWon'] =   number_format($row["scourgeWon"],"0",".",",");

		$data['sentinelPercent']  = 0;
		$data['scourgePercent'] =   0;
		$data['drawPercent']  =     0;

		if ($data['totals']>=1)
		{
			$data['sentinelPercent'] =  round(($data['sentinelWonRaw']/$data['totals'])*100,1);
			$data['scourgePercent'] =   round(($data['scourgeWonRaw']/$data['totals'])*100,1);
			$data['drawPercent'] =      round(($data['draw']/$data['totals'])*100,1);
		}
		
		$mergedArray = CMap::mergeArray($this->getGamesSummaryResult(),$this->getGamesDuration());

		$data = CMap::mergeArray($data,$mergedArray);
		return $this->render('gamesSummary',$data);

	}
}