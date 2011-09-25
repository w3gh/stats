<?php

class MostAssistsHero extends Portlet
{

	public $player='';
	
	public function renderContent()
	{
		$commandBuilder = app()->db->getCommandBuilder();

		$sql = "
			SELECT
				original,
				description,
				max(assists) AS maxassists
			FROM dotaplayers AS a
			LEFT JOIN gameplayers AS b
				ON b.gameid = a.gameid and a.colour = b.colour
			LEFT JOIN heroes ON hero = heroid
			WHERE LOWER(name) = LOWER(:username)
			GROUP BY original
			ORDER BY max(assists) DESC LIMIT 1";

		$command = $commandBuilder->createSqlCommand($sql,array(':username'=>$this->player));
		$list = $command->queryRow();

		$data=array();
		$data['hero']=      strtoupper(trim($list['original'])) OR 'blank';

		$heropath = $this->owner->assetsUrl.'img/heroes/'.$data['hero'].'.gif';

		$data['heroname']=  $list['description'];
		$data['count']=     $list['maxassists'];

		$data['heroimg'] = CHtml::image($heropath,$data['heroname']);

		$this->render('mostAssistsHero',$data);
	}
}