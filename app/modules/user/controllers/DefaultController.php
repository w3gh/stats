<?php

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='default';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionRegister()
    {
        $this->render('register');
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
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
