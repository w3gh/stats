<?php

class PlayerGamesDurations extends Portlet
{
	public $player='';

	protected function getPlayerGamesDurations()
	{
		$commandBuilder = app()->db->getCommandBuilder();
		$sql = "
			SELECT
				MIN(datetime) AS firstgame,
				MAX(datetime) AS lastgame,
				MIN(loadingtime) AS minloading,
				MAX(loadingtime) AS maxloading,
				AVG(loadingtime) AS avgloading,
				MIN(`left`) AS minleft,
				MAX(`left`) AS maxleft,
				AVG(`left`) AS avgleft,
				SUM(`left`) AS totalleft
			FROM gameplayers AS gp
			LEFT JOIN games  AS g ON g.id=gp.gameid
			LEFT JOIN dotaplayers AS dp ON dp.gameid=g.id AND dp.colour=gp.colour
			LEFT JOIN dotagames AS dg ON g.id=dg.gameid
			WHERE LOWER(name) = LOWER(:username) LIMIT 1";

		$command = $commandBuilder->createSqlCommand($sql,array(':username'=>$this->player));

		$row = $command->queryRow();

		$data = array();

		$data['firstGame']  =     $row['firstgame'];
		$data['lastGame']   =     $row['lastgame'];
		$data['minLoading'] =     Util::millisecondsToTime($row['minloading']);
		$data['maxLoading'] =     Util::millisecondsToTime($row['maxloading']);
		$data['avgLoading'] =     Util::millisecondsToTime($row['avgloading']);
		$data['minDuration'] =    Util::secondsToTime($row['minleft']);
		$data['maxDuration'] =    Util::secondsToTime($row['maxleft']);
		$data['avgDuration'] =    Util::secondsToTime($row['avgleft']);
		$data['totalDuration'] =  Util::secondsToTime($row['totalleft']);

		$data['totalHours'] = round($row['totalleft']/ 3600,1);
		$data['totalMinutes'] = round($row['totalleft']/ 3600*60,1);
		return $data;
	}

	public function renderContent()
	{
		$data = $this->getPlayerGamesDurations();
		$this->render('playerGamesDurations',$data);

	}
}