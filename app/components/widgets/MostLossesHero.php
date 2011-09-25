<?php

class MostLossesHero extends Portlet
{

	public $player='';

	public function renderContent()
	{

		$commandBuilder = app()->db->getCommandBuilder();

		$sql = "
			SELECT
				original,
				description,
				COUNT(*) AS losses
			FROM gameplayers AS gp
			LEFT JOIN games AS g ON g.id=gp.gameid
			LEFT JOIN dotaplayers AS dp
				ON dp.gameid=g.id AND dp.colour=gp.colour
			LEFT JOIN dotagames AS dg ON g.id=dg.gameid
			LEFT JOIN heroes ON hero = heroid
			WHERE LOWER(name) = LOWER(:username)
				AND(
						(winner=2 AND dp.newcolour>=1 AND dp.newcolour<=5)
					OR
						(winner=1 AND dp.newcolour>=7 AND dp.newcolour<=11)
					)
			GROUP BY original
			ORDER BY losses DESC LIMIT 1";

		$command = $commandBuilder->createSqlCommand($sql,array(':username'=>$this->player));
		$list = $command->queryRow();

		$data=array();
		$data['hero']= (trim($list['original']) !='') ? strtoupper(trim($list['original'])):'blank';

		$heropath = $this->owner->assetsUrl.'img/heroes/'.$data['hero'].'.gif';

		$data['heroname']=  $list['description'];
		$data['count']=     $list['losses'];

		$data['heroimg'] = CHtml::image($heropath,$data['heroname']);
		
		$this->render('mostLossesHero',$data);
	}
}