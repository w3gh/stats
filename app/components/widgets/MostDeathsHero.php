<?php

class MostDeathsHero extends Portlet
{

	public $player='';
	
	public function renderContent()
	{
		$commandBuilder = app()->db->getCommandBuilder();

		$sql = "
			SELECT
				original,
				description,
				max(deaths) AS maxdeaths
			FROM dotaplayers AS a
			LEFT JOIN gameplayers AS b
				ON b.gameid = a.gameid and a.colour = b.colour
			LEFT JOIN heroes on hero = heroid
			WHERE LOWER(name) = LOWER(:username)
			GROUP BY original
			ORDER BY maxdeaths DESC LIMIT 1";

		$command = $commandBuilder->createSqlCommand($sql,array(':username'=>$this->player));
		$list = $command->queryRow();

		$data=array();
		$data['hero']= (trim($list['original']) !='') ? strtoupper(trim($list['original'])):'blank';

		$heropath = $this->owner->assetsUrl.'img/heroes/'.$data['hero'].'.gif';

		$data['heroname']=  $list['description'];
		$data['count']=     $list['maxdeaths'];

		$data['heroimg'] = CHtml::image($heropath,$data['heroname']);
		
		$this->render('mostDeathsHero',$data);
	}
}