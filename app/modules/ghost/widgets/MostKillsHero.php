<?php

class MostKillsHero extends Portlet
{
	
	public $player='';

	public function renderContent()
	{
		$commandBuilder = app()->db->getCommandBuilder();
		
		$sql = "
			SELECT
				original,
				description,
				max(kills) AS maxkills
			FROM dotaplayers AS dp
			LEFT JOIN gameplayers AS gp
				ON gp.gameid = dp.gameid AND dp.colour = gp.colour
			LEFT JOIN heroes on hero = heroid
			WHERE LOWER(name)= LOWER(:username)
			GROUP BY original
			ORDER BY maxkills DESC LIMIT 1 ";

		$command = $commandBuilder->createSqlCommand($sql,array(':username'=>$this->player));
		$list = $command->queryRow();

		$data=array();
		$data['hero']= (trim($list['original']) !='') ? strtoupper(trim($list['original'])):'blank';

		$heropath = $this->owner->assetsUrl.'img/heroes/'.$data['hero'].'.gif';

		$data['heroname']=  $list['description'];
		$data['count']=     $list['maxkills'];

		$data['heroimg'] = CHtml::image($heropath,$data['heroname']);
		
		return $this->render('mostKillsHero',$data);
	}
}