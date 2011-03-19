<?php

class PlayersController extends Controller
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
				'actions'=>array('index','player','autocompleteplayername','testrank','heroes','games'),
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

	 public function actionTestrank()
	 {
	   //Run Ranker method VERY BIG OPERATION
	   echo Yii::app()->ranker->run(10);
	 }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPlayer($name,$server)
	{

    $model=Players::model()->findPlayer($name,$server);
    $servers=Servers::model()->findByPlayerName($name);

    if(empty($model)) {
      throw new CHttpException(404, 'Player not found');
    }

		$this->render('view',array(
			'model'=>$model,
      'servers'=>$servers,
      'server'=>$server,
      'name'=>$name,
		));
	}

  public function actionHeroes($name,$server)
  {

    $model=Players::model()->findHeroes($name,$server);
    $servers=Servers::model()->findByPlayerName($name);
      if(empty($model))
        throw new CHttpException(404, 'Heroes not found');


    $dataProvider=new CArrayDataProvider($model, array(
      'sort'=>array(
        'attributes'=>array(
            'hero', 'win', 'loss', 'totgames', 'kills', 'deaths', 'assists', 'creepkills', 'creepdenies', 'neutralkills', 'towerkills'
        ),
      ),
    ));

    $this->render('heroes',
      array(
        'dataProvider'=>$dataProvider,
        'servers'=>$servers,
        'model'=>$model,
        'server'=>$server,
        'name'=>$name,
        )
      );
  }

  public function actionGames($name,$server)
  {
    $model=Players::model()->findGames($name,$server);
    $servers=Servers::model()->findByPlayerName($name);
      if(empty($model))
        throw new CHttpException(404, 'Games not found');

    $dataProvider=new CArrayDataProvider($model,array(
      //'sort'=>array()
    ));

    $this->render('games',array(
      'model'=>$model,
      'servers'=>$servers,
      'server'=>$server,
      'name'=>$name,
      'dataProvider'=>$dataProvider,
    ));
  }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

    $scenario=null;
    if(isset($_GET['Players']))
      $scenario='search';

    $model=new Players($scenario);
    $criteria=$countCriteria=new CDbCriteria();
    
    if($server=Yii::app()->getRequest()->getParam('server'))
    {
      $countCriteria->condition=$criteria->condition='s.id = :server';
      $countCriteria->params=$criteria->params=array(':server'=>$server);
    }
		  // clear any default values
		if(isset($_GET['Players']))
    {
      $model->unsetAttributes();
			$model->attributes=$_GET['Players'];
      $criteria->compare('gp.name',$model->name,true);
    }
    //show players from first server, then from second
    $criteria->group='gp.spoofedrealm, gp.name';

    //$rawData=$model::model()->byplayer()->dota()->bans()->admins()->findAll($criteria);
     

//		$dataProvider=new CArrayDataProvider($rawData,array(
//      'sort'=>array(
//          'attributes'=>array(
//              'name', 'totgames', 'kills', 'deaths'
//          ),
//      ),
//      'pagination'=>array(
//        'pageSize'=>$this->module->playersPerPage,
//      ),
//    ));

    // Yii can't count players propertly, use own method
    $count=$model::model()->countPlayers($countCriteria);

    $dataProvider=new CActiveDataProvider($model::model()->dota()->bans()->admins(),array(
       'sort'=>array(
            'attributes'=>array(
                'name', 'totgames', 'kills', 'deaths'
            ),
        ),
      'totalItemCount'=>$count,
      'criteria'=>$criteria,
      'pagination'=>array(
        'pageSize'=>$this->module->playersPerPage,
      ),
    ));

    $this->breadcrumbs->mergeWith(array('Players'));

    $this->tabs->copyFrom(array());

    $this->renderAjax('index',array(
      'dataProvider'=>$dataProvider,
      'model'=>$model,
      'servers'=>Servers::model()->findAll(),
    ));

	}

  public function actionAutoCompletePlayerName()
  {
    if (Yii::app()->getRequest()->getIsAjaxRequest() && isset($_GET['q'])) {

        $name = $_GET['q'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'gp.name LIKE :name';
        $criteria->params = array(':name'=>"$name%");
        $criteria->limit = 10;
        
        if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
            $criteria->limit = $_GET['limit'];
        }

        $players = Players::model()->byplayer()->dota()->bans()->admins()->findAll($criteria);

        $output = '';
        foreach ($players as $player) {
            $output .= $player->name."\n";
        }
        echo $output;
    }
  }


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Players::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Players-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
