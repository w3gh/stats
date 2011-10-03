<?php

Yii::import('zii.widgets.CMenu');

class Menu extends CMenu {


	public $renderOpenTag=true;


	protected function renderMenu($items)
	{
		if(count($items))
		{
			if($this->renderOpenTag) echo CHtml::openTag('ul',$this->htmlOptions)."\n";
			$this->renderMenuRecursive($items);
			if($this->renderOpenTag) echo CHtml::closeTag('ul');
		}
	}
}