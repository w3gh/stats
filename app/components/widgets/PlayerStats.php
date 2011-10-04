<?php

/**
 * 
 */
class PlayerStats extends PlayerGamesDurations
{

	protected function getPlayerSumStats()
	{
		$commandBuilder = app()->db->getCommandBuilder();

		$sql="
		SELECT
			COUNT(dp.id) AS count,
			SUM(kills) AS sumkills,
			SUM(deaths) AS sumdeaths,
			SUM(creepkills) AS sumcreeps,
			SUM(creepdenies) AS sumdenies,
			SUM(assists) AS sumassists,
			SUM(neutralkills) AS sumneutrals,
			SUM(towerkills) AS sumtowers,
			SUM(raxkills) AS sumraxs,
			SUM(courierkills) AS sumcouriers,
			name
		FROM dotaplayers AS dp
		LEFT JOIN gameplayers AS b ON b.gameid = dp.gameid AND dp.colour = b.colour
		WHERE LOWER(name)= LOWER(:username)
		GROUP BY name
		ORDER BY SUM(kills) DESC
		LIMIT 1";

		$command = $commandBuilder->createSqlCommand($sql,array(':username'=>$this->player));
		$row = $command->queryRow();

		$data=array();

		$data['name']=$row['name'];

		$data['kills']=app()->format->number($row['sumkills']);
		$data['killsRaw']=$row['sumkills'];

		$data['deaths']=app()->format->number($row['sumdeaths']);
		$data['deathsRaw']=$row['sumdeaths'];

		$data['assists']=app()->format->number($row['sumassists']);
		$data['assistsRaw']=$row['sumassists'];

		$data['creepKills']=app()->format->number($row['sumcreeps']);
		$data['creepKillsRaw']=$row['sumcreeps'];

		$data['creepDenies']=app()->format->number($row['sumdenies']);
		$data['creepDeniesRaw']=$row['sumdenies'];

		$data['neutralKills']=app()->format->number($row['sumneutrals']);
		$data['neutralKillsRaw']=$row['sumneutrals'];

		$data['towerKills']=app()->format->number($row['sumtowers']);
		$data['towerKillsRaw']=$row['sumtowers'];

		$data['raxKills']=app()->format->number($row['sumraxs']);

		$data['courierKills']=app()->format->number($row['sumcouriers']);
		$data['courierKillsRaw']=$row['sumcouriers'];

	if ($row['sumdeaths'] >=1)
		$data['kdratio'] = round($row['sumkills']/$row['sumdeaths'],1);
	else
		$data['kdratio'] = 0;

		return $data;
	}

	protected function getPlayerGameResults()
	{
		$commandBuilder = app()->db->getCommandBuilder();
		//wins
		$sql['wins'] = "
		SELECT
			COUNT(*) AS count
		FROM gameplayers
		LEFT JOIN games ON games.id=gameplayers.gameid
		LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour
		LEFT JOIN dotagames ON games.id=dotagames.gameid
		WHERE LOWER(name) = LOWER(:username)
			AND (
				(winner=1 AND dotaplayers.newcolour>=1 AND dotaplayers.newcolour<=5)
				OR (winner=2 AND dotaplayers.newcolour>=7 AND dotaplayers.newcolour<=11))
			AND gameplayers.`left`/games.duration >= :minPlayedRatio LIMIT 1";

		//losses
		$sql['losses'] = "
		SELECT
			COUNT(*) AS count
		FROM gameplayers
		LEFT JOIN games ON games.id=gameplayers.gameid
		LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id AND dotaplayers.colour=gameplayers.colour
		LEFT JOIN dotagames ON games.id=dotagames.gameid
		WHERE LOWER(name)=LOWER(:username)
			AND (
				(winner=2 AND dotaplayers.newcolour>=1 AND dotaplayers.newcolour<=5)
				OR (winner=1 AND dotaplayers.newcolour>=7 AND dotaplayers.newcolour<=11)
				)
			AND gameplayers.`left`/games.duration >= :minPlayedRatio  LIMIT 1";
		
		$params=array(':username'=>$this->player,':minPlayedRatio'=>param('minPlayedRatio'));
		$data=array();
		foreach($sql as $id => $query){
			$command = $commandBuilder->createSqlCommand($query,$params);
			$arr=$command->queryRow();
			$data[$id]=$arr['count'];
		}
		$data['totalGames']=(int)$data['wins']+(int)$data['losses'];
		return $data;
	}


	protected function getPlayerDisconnectsCount()
	{
		$sql = "
		SELECT
		 SUM(
		 		(gp.`leftreason` LIKE ('%has lost the connection%'))
		 OR (gp.`leftreason` LIKE ('%was dropped%'))
		 OR (gp.`leftreason` LIKE ('%Lagged out%'))
		 OR (gp.`leftreason` LIKE ('%Dropped due to%'))
		 OR (gp.`leftreason` LIKE ('%Lost the connection%'))
		 ) AS count
		 FROM gameplayers as gp
		 LEFT JOIN games ON games.id=gp.gameid
		 LEFT JOIN dotaplayers ON dotaplayers.gameid=games.id
		 AND dotaplayers.colour=gp.colour
		 LEFT JOIN dotagames AS dg ON games.id=dg.gameid
		 WHERE LOWER(gp.name)=LOWER(:username) AND dg.winner <> 0
		 LIMIT 1";
	}

	public function renderContent()
	{
		$data=$this->getPlayerGameResults()+
		      $this->getPlayerSumStats()+
		      $this->getPlayerGamesDurations();

		if ($data['totalMinutes']>0)
		{
			$data['killsPerMin'] = round($data['killsRaw']/$data['totalMinutes'],2);

			if ($data['totalHours']>0)
				$data['killsPerHour'] = round($data['killsRaw']/$data['totalHours'],2);
			else
				$data['killsPerHour'] = 0;

			$data['deathsPerMin'] = round($data['deathsRaw']/$data['totalMinutes'],2);
			$data['creepsPerMin'] = round($data['creepKillsRaw']/$data['totalMinutes'],2);
		}
		else
		{
			$data['killsPerMin'] = 0;
			$data['deathsPerMin'] = 0;
			$data['creepsPerMin'] =0;
			$data['killsPerHour'] = 0;
		}

		$data['killsPerGame']=0;
		$data['deathsPerGame']=0;
		$data['assistsPerGame']=0;
		$data['discPercent']=0;
		$data['winLoose']=0;

		if ($data['totalGames']>0)
		{
			$data['killsPerGame'] = round($data['killsRaw']/$data['totalGames'],2);
			$data['deathsPerGame'] = round($data['deathsRaw']/$data['totalGames'],2);
			$data['assistsPerGame'] = round($data['assistsRaw']/$data['totalGames'],2);
			//$DiscPercent = ROUND($disc/($disc+$data['totalGames']), 4)*100;

			//@TODO
			$data['discPercent'] = 0;
			
			$data['winLoose']=0;
			if($data['wins'] != 0 )
			{
				$data['winLoose'] = round($data['wins']/$data['totalGames'], 4)*100;
			}
		}

		$data['killsPercent'] = 0;
		if ($data['killsRaw'] >0)
	  {
		  $data['killsPercent'] = round($data['killsRaw']/($data['killsRaw']+$data['deathsRaw']), 4)*100;
	  }

		$this->render('playerStats',$data);
	}
}