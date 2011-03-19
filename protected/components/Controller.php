<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var CMap the breadcrumbs of the current page. T
	 */
	public $breadcrumbs;

  /**
   * @var CStack the collection of menu items
   */
	public $menu, $menu_top;

  /**
   *
   * @var CStack the collection of tab items
   */
  public $tabs;

	public $baseUrl;

	protected $_baseAssetsPath;

  protected $_themeAssetsPath;

  protected $_moduleAssetsPath;

  protected $_packages;

	public function init()
	{
		parent::init();
    $this->breadcrumbs = new CMap();
    $this->menu = new CStack(require Yii::getPathOfAlias('application.config').'/menu.php');
    $this->menu_top = new CStack(require Yii::getPathOfAlias('application.config').'/menu_top.php');
    $this->tabs = new CStack();
    
    /* @var $app->clientScript CClientScript */
   // text/html; charset=UTF-8
    Yii::app()->clientScript->registerMetaTag('text/html; charset=UTF-8', null, 'Content-Type');

    Yii::app()->getClientScript()->reset();

    //Register assets folder for protected/modules/yourmodule/assets
		if($this->module !== null) {
      $moduleAssetsFolder = $this->module->basePath.'/assets';
      if(is_dir($moduleAssetsFolder))
        $this->_moduleAssetsPath = Yii::app()->assetManager->publish($moduleAssetsFolder);
    }
    
    //Register assets folder for protected/assets
    $baseAssetsFolder = Yii::app()->basePath.'/assets';
    if(is_dir($baseAssetsFolder))
      $this->_baseAssetsPath = Yii::app()->assetManager->publish($baseAssetsFolder);

    //Register assets folder for theme/yourtheme/assets
    if(($theme=Yii::app()->getTheme())!==null)
    {
      /** @var $theme CTheme */
      $themeAssetsFolder = $theme->basePath.'/assets';
      if(is_dir($themeAssetsFolder))
        $this->_themeAssetsPath = Yii::app()->assetManager->publish($themeAssetsFolder, false, -1, YII_DEBUG);
    }
    //var_dump($theme->getLayoutFile($this,"main")); die();
    Yii::app()->clientScript->registerCoreScript('jquery.ui');
    //Yii::app()->clientScript->renderCoreScripts();

    if($theme!==null) Yii::app()->clientScript->registerCssFile($this->_themeAssetsPath.'/css/style.css', 'screen');

    //Register base path url
    $this->baseUrl=Yii::app()->request->baseUrl;

    QTip::qtip('.row input[title], a[title]');

	}

  public function getAssetsPath()
  {
    if(Yii::app()->getTheme()!==null)
      return $this->_themeAssetsPath;
    if($this->module !== null)
      return $this->_moduleAssetsPath;
      
    return $this->_baseAssetsPath;
  }

  public function getThemeAssetsPath()
  {
    return $this->_themeAssetsPath;
  }

  public function getModuleAssetsPath()
  {
    return $this->_moduleAssetsPath;
  }

  public function getBaseAssetsPath()
  {
    return $this->_baseAssetsPath;
  }

  public function  setPageTitle($value) {
    if($value != Yii::app()->name)
      parent::setPageTitle(Yii::t('site' ,$value).' | '.Yii::app()->name);
    else
      parent::setPageTitle(Yii::app()->name);
  }

  protected function registerCoreScripts()
  {
    
  }

  /*
   * @see renderPartial
   */
  public function renderAjax($view,$data=null,$return=false)
  {
    if(Yii::app()->request->isAjaxRequest)
      return $this->renderPartial($view,$data,$return);
    else
      return $this->render($view,$data,$return);
  }
}