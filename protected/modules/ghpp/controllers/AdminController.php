<?php

class AdminController extends Controller
{
  public $layout='//layouts/dashboard';

  public $dashboard_menu=array();

  public function init()
  {
    parent::init();
    $this->dashboard_menu=array(
      array('label'=>Yii::t('menuTop', 'Home'), 'url'=>array('/post/index')),
      array('label'=>Yii::t('menuTop', 'About'), 'url'=>array('/site/page', 'view'=>'about')),
      array('label'=>Yii::t('menuTop', 'For Bot'), 'url'=>array('/site/sender')),
      array('label'=>Yii::t('menuTop', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
      array('label'=>Yii::t('menuTop', 'Logout').'('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
    );
  }

	public function actionAdmins()
	{
		$this->render('admins');
	}

	public function actionBans()
	{
		$this->render('bans');
	}

	public function actionBots()
	{
		$this->render('bots');
	}

	public function actionComments()
	{
		$this->render('comments');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPosts()
	{
		$this->render('posts');
	}

	public function actionServers()
	{
		$this->render('servers');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}