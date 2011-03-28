<?php

class ServersController extends Controller
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
				'actions'=>array('create','update','updateServers'),
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
      'Servers'=>array('index'),
      $model->name,
    ));

    $this->tabs->copyFrom(array(
      array('label'=>'List Servers', 'url'=>array('index')),
      array('label'=>'Create Servers', 'url'=>array('create')),
      array('label'=>'Update Servers', 'url'=>array('update', 'id'=>$model->id)),
      array('label'=>'Delete Servers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
      array('label'=>'Manage Servers', 'url'=>array('admin')),
    ));

		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Servers;

		$this->performAjaxValidation($model);

		if(isset($_POST['Servers']))
		{
			$model->attributes=$_POST['Servers'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
        
    $this->breadcrumbs->mergeWith(array(
      'Servers'=>array('index'),
      'Create',
    ));

    $this->tabs->copyFrom(array(
      array('label'=>'List Servers', 'url'=>array('index')),
      array('label'=>'Manage Servers', 'url'=>array('admin')),
    ));
    
		$this->render('create',array(
			'model'=>$model,
      'serversData'=>Servers::model()->getList(),
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

		if(isset($_POST['Servers']))
		{
			$model->attributes=$_POST['Servers'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

  /**
   * Add new servers into table
   */
  public function actionUpdateServers()
  {
      $playerServers   = Players::model()->servers()->findAll();
      $bansServers     = Bans::model()->servers()->findAll();
      $adminsServers   = Admins::model()->servers()->findAll();
      
      $serversList     = Servers::model()->findAll();

      $servers=CMap::mergeArray($playerServers, $bansServers);
      $servers=CMap::mergeArray($servers, $adminsServers);

      $exServers = $avServers = array();
      foreach($serversList as $id => $server)
      {
        $exServers[$server->server]=$server->server;
      }
      
      foreach($servers as $id => $server)
        $avServers[$server->server]=$server->server;//array_push(, $server->server);

      foreach($avServers as $id => $server)
      {
        //var_dump($server->server);
        if(!isset($exServers[$id]))
        {
          $s = new Servers;
          $s->server=$server;
          $s->name=gethostbyaddr($server);
          $s->port=6112;
          $s->save();
          Yii::app()->user->setFlash('system', 'Added '.$server.' to servers list');
        }
      }

			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    
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
		$dataProvider=new CActiveDataProvider('Servers');

    $this->breadcrumbs->mergeWith(array(
      'Servers',
    ));

    $this->tabs->copyFrom(array(
      array('label'=>'Create Servers', 'url'=>array('create')),
      array('label'=>'Manage Servers', 'url'=>array('admin')),
    ));
    
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Servers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Servers']))
			$model->attributes=$_GET['Servers'];

    $this->breadcrumbs->mergeWith(array(
      'Servers'=>array('index'),
      'Manage',
    ));

    $this->tabs->copyFrom(array(
      array('label'=>'Fill Servers', 'url'=>array('updateservers')),
      array('label'=>'List Servers', 'url'=>array('index')),
      array('label'=>'Create Servers', 'url'=>array('create')),
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
		$model=Servers::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='servers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
