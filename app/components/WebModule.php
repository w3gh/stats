<?php

/**
 * @author Nikolay Kostyurin <jilizart@gmail.com>
 */
class WebModule extends CWebModule
{
    private $_assetsUrl;

    /**
   	 * @return string the base URL that contains all published asset files of app.
   	 */
   	public function getAssetsUrl()
   	{
   		if($this->_assetsUrl!==null){
   			return $this->_assetsUrl;
   		}
   		else{
   			$assetsPath=Yii::getPathOfAlias($this->name.'.assets');
   			$this->setAssetsUrl($assetsPath);
   			return $this->_assetsUrl;
   		}
   	}

   	/**
   	 * @param string $value the base URL that contains all published asset files of app.
   	 */
   	public function setAssetsUrl($path)
   	{
   		if(($assetsPath=realpath($path))===false || !is_dir($assetsPath) || !is_writable($assetsPath))
   			throw new CException(__('app','Assets path "{path}" is not valid. Please make sure it is a directory writable by the Web server process.',
   				array('{path}'=>$path)));

   		$assetsUrl = app()->assetManager->publish($path,false,-1,YII_DEBUG);

   		$this->_assetsUrl=$assetsUrl.'/';
   	}
}