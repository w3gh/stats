<?php

class GhppModule extends CWebModule
{
  public $playersPerPage=20;
  public $gamesPerPage=20;
  public $adminsPerPage=20;
  public $bansPerPage=20;

  
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			$this->id.'.models.*',
			$this->id.'.components.*',
      $this->id.'.components.widgets.*',
      $this->id.'.components.GHtml.*',
      $this->id.'.components.GRank.*',
		));

	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

}
