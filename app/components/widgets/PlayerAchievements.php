<?php

class PlayerAchievements extends Portlet
{
	public $player;

	public function renderContent()
	{
		$this->render('playerAchievements');
	}
}