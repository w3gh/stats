<?php

Yii::import('zii.widgets.CBreadcrumbs');

/**
 * 
 */
class Breadcrumbs extends CBreadcrumbs
{
	public $htmlOptions=array('class'=>'breadcrumb');

	public $separator='<span class="divider">/</span>';


	public function run()
	{
		if(empty($this->links))
			return;

		echo CHtml::openTag('ul',$this->htmlOptions)."\n";
		$links=array();
		if($this->homeLink===null)
			$links[]=CHtml::link(Yii::t('zii','Home'),Yii::app()->homeUrl);
		else if($this->homeLink!==false)
			$links[]=$this->homeLink;
		foreach($this->links as $label=>$url)
		{
			if(is_string($label) || is_array($url))
				$links[]='<li>'.CHtml::link($this->encodeLabel ? CHtml::encode($label) : $label, $url).'</li>';
			else
				$links[]='<li>'.($this->encodeLabel ? CHtml::encode($url) : $url).'</li>';
		}
		echo implode($this->separator,$links);
		echo CHtml::closeTag('ul');
	}
}