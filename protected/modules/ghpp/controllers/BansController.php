<?php

class BansController extends Controller
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
				'actions'=>array('index','view','autocompleteplayername'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
      'Bans'=>array('index'),
      $model->name,
    ));

    $this->tabs->copyFrom(array(
      array('label'=>Yii::t('ghppModule.bans', 'List Bans'), 'url'=>array('index')),
      array('label'=>Yii::t('ghppModule.bans', 'Create Bans'), 'url'=>array('create')),
      array('label'=>Yii::t('ghppModule.bans', 'Update Bans'), 'url'=>array('update', 'id'=>$model->id)),
      array('label'=>Yii::t('ghppModule.bans', 'Delete Bans'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('ghppModule.bans', 'Are you sure you want to delete this item?'))),
      array('label'=>Yii::t('ghppModule.bans', 'Manage Bans'), 'url'=>array('admin')),
    ));

    $this->renderAjax('view',array(
      'model'=>$model,
    ));

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Bans;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bans']))
		{
			$model->attributes=$_POST['Bans'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

    $this->breadcrumbs->mergeWith(array(
      Yii::t('ghppModule.bans', 'Bans')=>array('index'),
      Yii::t('ghppModule.bans', 'Create'),
    ));

    $this->tabs->copyFrom(array(
      array('label'=>Yii::t('ghppModule.bans', 'List Bans'), 'url'=>array('index')),
      array('label'=>Yii::t('ghppModule.bans', 'Manage Bans'), 'url'=>array('admin')),
    ));

		$this->render('create',array(
			'model'=>$model,
      'servers'=>Servers::model()->list,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Bans']))
		{
			$model->attributes=$_POST['Bans'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

    $this->breadcrumbs->mergeWith(array(
      Yii::t('ghppModule.bans', 'Bans')=>array('index'),
      $model->name=>array('view','id'=>$model->id),
      Yii::t('ghppModule.bans', 'Update'),
    ));

    $this->tabs->copyFrom(array(
      array('label'=>Yii::t('ghppModule.bans', 'List Bans'), 'url'=>array('index')),
      array('label'=>Yii::t('ghppModule.bans', 'Create Bans'), 'url'=>array('create')),
      array('label'=>Yii::t('ghppModule.bans', 'View Bans'), 'url'=>array('view', 'id'=>$model->id)),
      array('label'=>Yii::t('ghppModule.bans', 'Manage Bans'), 'url'=>array('admin')),
    ));

    $this->renderAjax('update',array(
      'model'=>$model,
      'servers'=>Servers::model()->list,
    ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
    $scenario=null;
    if(isset($_GET['Bans']))
      $scenario='search';

    $model=new Bans($scenario);
    $criteria=new CDbCriteria();

		if(isset($_GET['Bans']))
    {
      $model->unsetAttributes();
			$model->attributes=$_GET['Bans'];

      $criteria->compare('b.name',$model->name,true);
    }

    if($server=Yii::app()->getRequest()->getParam('server'))
    {
      $criteria->condition='s.id = :server';
      $criteria->params=array(':server'=>$server);
    }

		$dataProvider=new CActiveDataProvider($model,array(
      'criteria'=>$criteria,
      'sort'=>array(
        'attributes'=>array(
          'name', 'reason', 'gamename', 'datetime', 'admin', 'servername', 'boname'
        ),
      ),
      'pagination'=>array(
        'pageSize'=>$this->module->bansPerPage,
      ),
    ));
    

    $this->breadcrumbs->mergeWith(array(Yii::t('ghppModule.bans', 'Bans')));

    $this->tabs->copyFrom(array(
      array('label'=>Yii::t('ghppModule.bans', 'Create Bans'), 'url'=>array('create')),
      array('label'=>Yii::t('ghppModule.bans', 'Manage Bans'), 'url'=>array('admin')),
    ));

    $this->pageTitle=Yii::t('ghppModule.bans', 'Bans');

    $this->renderAjax('index',array(
      'dataProvider'=>$dataProvider,
      'model'=>$model,
      'servers'=>Servers::model()->findAll(),
    ));
	}

  public function actionAutoCompletePlayerName()
  {
    if (Yii::app()->request->isAjaxRequest && isset($_GET['q'])) {

        $name = $_GET['q'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'b.name LIKE :name';
        $criteria->params = array(':name'=>"$name%");
        $criteria->limit = 10;

        if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
            $criteria->limit = $_GET['limit'];
        }

        $players = Bans::model()->findAll($criteria);

        $output = '';
        foreach ($players as $player) {
            $output .= $player->name."\n";
        }
        echo $output;
    }
  }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Bans('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bans']))
			$model->attributes=$_GET['Bans'];

    $this->breadcrumbs->mergeWith(array(
      Yii::t('ghppModule.bans', 'Bans')=>array('index'),
      Yii::t('ghppModule.bans', 'Manage'),
    ));

    $this->tabs->copyFrom(array(
      array('label'=>Yii::t('ghppModule.bans', 'List Bans'), 'url'=>array('index')),
      array('label'=>Yii::t('ghppModule.bans', 'Create Bans'), 'url'=>array('create')),
    ));

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Bans::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='bans-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
