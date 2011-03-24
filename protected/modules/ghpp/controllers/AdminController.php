<?php

class AdminController extends Controller
{
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