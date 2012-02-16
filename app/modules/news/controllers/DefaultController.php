<?php

class DefaultController extends Controller
{
    /**
   	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   	 * using two-column layout. See 'protected/views/layouts/column2.php'.
   	 */
   	public $layout='//layouts/column2';

   	/**
   	 * Displays a particular model.
   	 * @param integer $id the ID of the model to be displayed
   	 */
   	public function actionView($id)
   	{
   		$model = $this->loadModel($id);

   		$this->render('view',array(
   			'model'=>$model,
   		));
   	}

   	/**
   	 * Lists all models.
   	 */
   	public function actionIndex()
   	{
   		$dataProvider=new CActiveDataProvider('News');
   		$this->render('index',array(
   			'dataProvider'=>$dataProvider,
   		));
   	}

   	/**
   	 * Returns the data model based on the primary key given in the GET variable.
   	 * If the data model is not found, an HTTP exception will be raised.
   	 * @param integer the ID of the model to be loaded
   	 */
   	public function loadModel($id)
   	{
   		$model=News::model()->findByPk($id);
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
   		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
   		{
   			echo CActiveForm::validate($model);
   			app()->end();
   		}
   	}
}