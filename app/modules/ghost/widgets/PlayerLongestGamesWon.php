<?php

class PlayerLongestGamesWon extends Portlet
{
	public $player;
	public $limit=1;
	
	public function renderContent()
	{
		$commandBuilder = app()->db->getCommandBuilder();
		$sql = "
			SELECT
				(dotagames.min * 60 + dotagames.sec) AS longgamewon,
				dotagames.gameid,
				games.gamename,
				games.duration,
				dotaplayers.kills,
				dotaplayers.deaths,
				dotaplayers.creepkills,
				dotaplayers.creepdenies,
				dotaplayers.assists,
				dotaplayers.neutralkills
			FROM gameplayers
			LEFT JOIN games ON games.id = gameplayers.gameid
			LEFT JOIN dotaplayers ON dotaplayers.gameid = games.id AND dotaplayers.colour = gameplayers.colour
			LEFT JOIN dotagames ON games.id = dotagames.gameid
			WHERE LOWER(name) = LOWER(:username)
				AND (
					(
						winner = 1
						AND dotaplayers.newcolour >= 1
						AND dotaplayers.newcolour <= 5
					)
					OR
					(
						winner = 2
						AND dotaplayers.newcolour >= 7
						AND dotaplayers.newcolour <= 11
					)
				)
			GROUP BY dotagames.gameid
			ORDER BY longgamewon DESC
			LIMIT :limit";

		$command = $commandBuilder->createSqlCommand($sql,array(
		                                                       ':username'=>$this->player,
		                                                       ':limit'=>$this->limit)
		);
		$games = $command->queryAll();
		$this->render('playerLongestGamesWon',array('games'=>$games));
	}

}