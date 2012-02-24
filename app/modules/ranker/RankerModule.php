<?php

class CRankerModule extends WebModule
{
	public function init()
	{
        parent::init();
		// import the module-level models and components
		$this->setImport(array(
			$this->name.'.models.*',
			$this->name.'.components.*',
			$this->name.'.widgets.*',
		));

        Yii::app()->setComponents(array(
            'ranker'=>array(
                'class'=>'GRanker'
            )
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
