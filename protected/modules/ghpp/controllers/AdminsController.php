<?php

class AdminsController extends Controller {

  /**
   * @return array action filters
   */
  public function filters() {
    return array(
      'accessControl', // perform access control for CRUD operations
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules() {
    return array(
      array('allow', // allow all users to perform 'index' and 'view' actions
        'actions' => array('index', 'view', 'bansby'),
        'users' => array('*'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
        'actions' => array('create', 'update'),
        'users' => array('@'),
      ),
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
        'actions' => array('admin', 'delete'),
        'users' => array('@'),
        //'users' => array('admin'),
      ),
      array('deny', // deny all users
        'users' => array('*'),
      ),
    );
  }

  /**
   * Displays a particular model.
   * @param integer $id the ID of the model to be displayed
   */
  public function actionView($id) {
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate() {
    $model = new Admins;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Admins'])) {
      $model->attributes = $_POST['Admins'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }

    $this->breadcrumbs->mergeWith(array(
      Yii::t('ghppModule.admins', 'Admins') => array('index'),
      Yii::t('ghppModule.admins', 'Create'),
    ));

    $this->tabs->copyFrom(array(
      array('label' => Yii::t('ghppModule.admins', 'List Admins'), 'url' => array('index')),
      array('label' => Yii::t('ghppModule.admins', 'Manage Admins'), 'url' => array('admin')),
    ));

    $this->render('create', array(
      'model' => $model,
      'servers' => Servers::model()->list,
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id) {
    $model = $this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    $this->performAjaxValidation($model);

    if (isset($_POST['Admins'])) {
      $model->attributes = $_POST['Admins'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }

    $this->breadcrumbs->copyFrom(array(
      Yii::t('ghppModule.admins', 'Admins') => array('index'),
      $model->name => array('view', 'id' => $model->id),
      Yii::t('ghppModule.admins', 'Update'),
    ));

    $this->tabs->copyFrom(array(
      array('label' => Yii::t('ghppModule.admins', 'List Admins'), 'url' => array('index')),
      array('label' => Yii::t('ghppModule.admins', 'Create Admins'), 'url' => array('create')),
      array('label' => Yii::t('ghppModule.admins', 'View Admins'), 'url' => array('view', 'id' => $model->id)),
      array('label' => Yii::t('ghppModule.admins', 'Manage Admins'), 'url' => array('admin')),
    ));


    $this->render('update', array(
      'model' => $model,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      // we only allow deletion via POST request
      $this->loadModel($id)->delete();

      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if (!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  /**
   * Lists all models.
   */
  public function actionIndex() {

    $model = new Admins();
    $model->banscount()->gameshosted();

    $this->breadcrumbs->mergeWith(array(
      'Admins',
    ));

    $this->tabs->copyFrom(array(
      array('label' => Yii::t('ghppModule.admins', 'Create Admins'), 'url' => array('create')),
      array('label' => Yii::t('ghppModule.admins', 'Manage Admins'), 'url' => array('admin')),
    ));

    $dataProvider = new CActiveDataProvider($model, array());
    $this->render('index', array(
      'dataProvider' => $dataProvider,
    ));
  }

  /**
   * List All bans By Admin
   */
  public function actionBansBy($name,$server) {
    $criteria = new CDbCriteria();
//    $criteria->condition = 'b.admin = :name';
//    $criteria->params = array(':name' => $name);
    $criteria->condition='s.id = :server AND b.admin = :name';
    $criteria->params=array(':server'=>$server, ':name'=>$name);
    $scenario=null;
    if(isset($_GET['Bans']))
      $scenario='search';

    $model = new Bans($scenario);
    

    if(isset($_GET['Bans']))
    {
      $model->unsetAttributes();
			$model->attributes=$_GET['Bans'];

      $criteria->compare('b.name',$model->name,true);
    }

    $rawData = $model->findAll($criteria);

    $this->breadcrumbs->mergeWith(array(
      Yii::t('ghppModule.admins', 'Admins') => array('index'),
      $name
    ));

    $this->tabs->copyFrom(array(
      array('label' => Yii::t('ghppModule.admins', 'Create Admins'), 'url' => array('create')),
      array('label' => Yii::t('ghppModule.admins', 'Manage Admins'), 'url' => array('admin')),
    ));

    $dataProvider = new CArrayDataProvider($rawData, array());
    $this->render('/bans/index', array(
      'dataProvider' => $dataProvider,
      'model' => $model,
      'servers'=>Servers::model()->findAll(),
    ));
  }

  /**
   * Manages all models.
   */
  public function actionAdmin() {
    $model = new Admins('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['Admins']))
      $model->attributes = $_GET['Admins'];


    $this->breadcrumbs->mergeWith(array(
      Yii::t('ghppModule.admins', 'Admins')=>array('index') ,
      'Manage'
      ));

    $this->tabs->copyFrom(array(
      array('label' => 'List Admins', 'url' => array('index')),
      array('label' => 'Create Admins', 'url' => array('create'))
    ));

    $this->render('admin', array(
      'model' => $model,
      'serversData' => Servers::model()->list,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id) {
    $model = Admins::model()->findByPk((int) $id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'admins-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

}
