<?php

Yii::import('zii.widgets.CMenu');

class Menu extends CMenu {


	public $renderOpenTag=true;


	protected function renderMenu($items)
	{
        if($this->renderOpenTag) echo CHtml::openTag('ul',$this->htmlOptions)."\n";
        $loginUrl = app()->controller->createUrl('site/login');
        $logoutUrl = app()->controller->createUrl('site/logout');
        $isGuest = app()->user->isGuest;
		if(count($items))
		{
			$this->renderMenuRecursive($items);
            echo CHtml::tag('li',array('class'=>'divider'));
		}
        echo CHtml::tag('li',array(),CHtml::link(($isGuest) ? 'Login':'Logout',($isGuest) ? $loginUrl:$logoutUrl));
        if($this->renderOpenTag) echo CHtml::closeTag('ul');
	}
}