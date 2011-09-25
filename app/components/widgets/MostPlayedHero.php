<?php

class MostPlayedHero extends Portlet
{

	public $player='';

	public function renderContent()
	{
		$commandBuilder = app()->db->getCommandBuilder();

		$sql = "
			SELECT
				SUM(`left`) AS timeplayed,
				original,
				description,
				COUNT(*) AS played
			FROM gameplayers AS gp
			LEFT JOIN games AS g
				ON g.id=gp.gameid
			LEFT JOIN dotaplayers AS dp
				ON dp.gameid=g.id AND dp.colour=gp.colour
			LEFT JOIN dotagames AS dg
				ON g.id=dg.gameid
			JOIN heroes ON hero = heroid
			WHERE LOWER(name)=LOWER(:username)
			GROUP BY original
			ORDER BY played DESC LIMIT 1";

		$command = $commandBuilder->createSqlCommand($sql,array(':username'=>$this->player));
		$list = $command->queryRow();

		$data=array();
		$data['hero']= (trim($list['original']) !='') ? strtoupper(trim($list['original'])):'blank';

		$heropath = $this->owner->assetsUrl.'img/heroes/'.$data['hero'].'.gif';

		$data['heroname']=  $list['description'];
		$data['count']=     $list['played'];

		$data['time'] = Util::secondsToTime($list['timeplayed']);

		$data['heroimg'] = CHtml::image($heropath,$data['heroname']);

		$this->render('mostPlayedHero',$data);
	}
}