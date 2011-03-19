<?php

class GamesController extends Controller
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('',''),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

    $model=$this->loadModel($id);

    $this->breadcrumbs->mergeWith(array(
      'Games'=>array('index'),
      $model->gamename,
    ));

    $this->tabs->copyFrom(array(
      array('label'=>'List Games', 'url'=>array('index')),
//      array('label'=>'Create Games', 'url'=>array('create')),
//      array('label'=>'Update Games', 'url'=>array('update', 'id'=>$model->id)),
//      array('label'=>'Delete Games', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//      array('label'=>'Manage Games', 'url'=>array('admin')),
    ));

		$this->render('view',array(
			'model'=>$model,
      'game'=>Games::model()->findGame($id),
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

    $this->breadcrumbs->mergeWith(array(
      'Games',
    ));

    $this->tabs->copyFrom(array(
//      array('label'=>'Create Games', 'url'=>array('create')),
//      array('label'=>'Manage Games', 'url'=>array('admin')),
    ));

    $model=Games::model()->admins()->bans()->servers();
    

		$dataProvider=new CActiveDataProvider($model);
    
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
		$model=Games::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='games-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
