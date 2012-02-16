<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	private $_assetsUrl;

	public $title='';
	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * @return string the base URL that contains all published asset files of app.
	 */
	public function getAssetsUrl()
	{

		if($this->_assetsUrl!==null){
			return $this->_assetsUrl;
		}
		else{
			$assetsPath=Yii::getPathOfAlias('application.assets');
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
		
		$assetsUrl = app()->assetManager->publish($path);

		$this->_assetsUrl=$assetsUrl.'/';
	}
}