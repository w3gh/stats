<?php

class SiteController extends PublicController
{

	private $_model=null;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
				'viewParam'=>'id',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->forward('news/index');
//		$data=array();
//		$date_format = param('dateFormat');
//		$news_per_page = param('newsPerPage');
//
//		$model= $this->loadModel();
//		if($model) {
//			$data['model'] = $model;
//			$data['title'] = $model->news_title;
//			$data['text'] = $model->news_content;
//			$data['date'] = date($date_format,strtotime($model->news_date));
//		}
//
//		//$model=new News();
//		$criteria=new CDbCriteria;
//		$total = $model->count($criteria);
//		$pages=new CPagination($total);
//		$pages->pageSize=$news_per_page;
//		$pages->applyLimit($criteria);
//		$list = $model->findAll($criteria);
//
//		$data['list'] = $list;
//		$data['pages'] = $pages;
//
//
//		$this->render('index',$data);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=app()->errorHandler->error)
	    {
	    	if(app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(param('adminEmail'),$model->subject,$model->body,$headers);
				app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		app()->user->logout();
		$this->redirect(app()->homeUrl);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			$id = app()->request->getParam('id',FALSE);
			if($id)
			{
				$this->_model=News::model()->findByPk($id);
			}
			if($this->_model===null)
				throw new CHttpException(404,__('app','No news found.'));
		}
		return $this->_model;
	}
}