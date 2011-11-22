<?php

class HeroesController extends PublicController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
		$minPlayedRatio = param('minPlayedRatio');
		
		$sql = "
			SELECT
				*,
				(kills*1.0/deaths) AS kdratio,
				(wins*1.0/losses) AS winratio,
				h.description AS description,
				summary,
				skills,
				stats
			FROM
			(
				SELECT
					COUNT(*) AS totgames,
					original,
					SUM(CASE WHEN(((dg.winner = 1 AND dp.newcolour < 6)
						OR (dg.winner = 2 AND dp.newcolour > 6))
						AND gp.`left`/g.duration >= :minPlayedRatio) THEN 1 ELSE 0 END) AS wins,
					SUM(CASE WHEN(((dg.winner = 2 AND dp.newcolour < 6)
						OR (dg.winner = 1 and dp.newcolour > 6))
						AND gp.`left`/g.duration >= :minPlayedRatio) THEN 1 ELSE 0 END) AS losses,
					SUM(kills) AS kills,
					SUM(deaths) AS deaths,
					SUM(assists) AS assists,
					SUM(creepkills) AS creepkills,
					SUM(creepdenies) AS creepdenies,
					SUM(neutralkills) AS neutralkills,
					SUM(towerkills) AS towerkills,
					SUM(raxkills) AS raxkills,
					SUM(courierkills) AS courierkills
				FROM dotaplayers AS dp
					LEFT JOIN heroes AS b ON hero = heroid
					LEFT JOIN dotagames AS dg ON dg.gameid = dp.gameid
					LEFT JOIN gameplayers AS gp ON gp.gameid = dp.gameid and dp.colour = gp.colour
					LEFT JOIN games AS g ON gp.gameid = g.id
				WHERE original=:heroid AND summary!= '-'
				GROUP BY original
			) AS y
			LEFT JOIN heroes AS h ON y.original = h.heroid
			LIMIT 1";

		$command = app()
						->db
						->getCommandBuilder()
						->createSqlCommand($sql,array(
										   ':heroid'=>$id,
										   ':minPlayedRatio'=>$minPlayedRatio,
										 ));

		$data['hero'] = $command->queryRow();
		$data['hid'] = strtoupper($data['hero']['original']);
		$data['description'] = $data['hero']['description'];
		
		if(app()->request->isAjaxRequest)
			return $this->renderPartial('view_ajax',$data);

		$this->render('view',$data);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Heroes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Heroes']))
		{
			$model->attributes=$_POST['Heroes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->heroid));
		}

		$this->render('create',array(
			'model'=>$model,
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Heroes']))
		{
			$model->attributes=$_POST['Heroes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->heroid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(app()->request->isPostRequest)
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

		//$dataProvider=new CActiveDataProvider('Heroes');
		$player='';
		$playername = app()->request->getParam('player','');
		if($playername)	$player = "AND LOWER(d.name) = ".app()->db->quoteValue(strtolower($playername));

		$model = Heroes::model();
		
		$minPlayedRatio = param('minPlayedRatio');
		$heroesPerPage = param('heroesPerPage');

		$criteria = new CDbCriteria();
		$criteria->addCondition("summary != '-'");
		$criteria->order='LOWER(description) ASC';
		$heroes = $model->findAll($criteria);

		$pages = new CPagination(count($heroes));
		$pages->setPageSize($heroesPerPage);
		
		$sort = new CSort();
		$sort->defaultOrder='LOWER(description)';
		$sort->attributes = array(
			'hero'  => 'description',
			'played' => 'totgames',
			'wins' => 'wins',
			'losses' => 'losses',
			'w_l' => 'winratio',
			'kills' => 'kills',
			'deaths' => 'deaths',
			'assists' => 'assists',
			'kd' => 'kdratio',
			'creeps' => 'creepkills',
			'denies' => 'creepdenies',
			'neutrals' => 'neutralkills',

		);

		$sql = "
			SELECT
				*,
				CASE WHEN (wins = 0) THEN 0 WHEN (losses = 0) THEN 1000 ELSE ((wins*1.0)/(losses*1.0)) END AS  winratio,
				CASE WHEN (kills = 0) THEN 0 WHEN (deaths = 0) THEN 1000 ELSE ((kills*1.0)/(deaths*1.0)) END AS kdratio
			FROM
				(
					SELECT
					 original,
					 description,
					 COUNT(*) AS totgames,
					 SUM(CASE WHEN(((c.winner = 1 AND a.newcolour < 6) OR (c.winner = 2 and a.newcolour > 6)) AND d.`left`/e.duration >= :minPlayedRatio) THEN 1 ELSE 0 END) AS wins,
					 SUM(CASE WHEN(((c.winner = 2 AND a.newcolour < 6) OR (c.winner = 1 AND a.newcolour > 6))
					 AND d.`left`/e.duration >= :minPlayedRatio) THEN 1 ELSE 0 END) AS losses,
					 AVG(kills) AS kills,
					 AVG(deaths) AS deaths,
					 AVG(assists) AS assists,
					 AVG(creepkills) AS creepkills,
					 AVG(creepdenies) AS creepdenies,
					 AVG(neutralkills) AS neutralkills
					FROM heroes AS b
					LEFT JOIN dotaplayers AS a ON hero = heroid
					LEFT JOIN dotagames AS c ON c.gameid = a.gameid
					LEFT JOIN gameplayers AS d ON d.gameid = a.gameid AND a.colour = d.colour
					LEFT JOIN games AS e ON d.gameid = e.id
					WHERE original <> 'NULL' AND c.winner <> 0  AND b.`summary` != CONVERT( _utf8 '-' USING latin1 )
					COLLATE latin1_swedish_ci
					$player
					GROUP BY original
				) AS t
			WHERE t.totgames > 0
			ORDER BY :sort
			LIMIT :offset, :limit";
		$connection = app()->db;
		$command = $connection->getCommandBuilder()->createSqlCommand($sql,array(
									':minPlayedRatio'=>$minPlayedRatio,
			            ':limit' => $pages->getLimit(),
			            ':sort' => $sort->getOrderBy(),
			            ':offset' => $pages->getOffset()
																																			 ));
		$heroes = $command->queryAll();
		$this->render('index',array(
			  'heroes'=>$heroes,
			  'heroesCount'=>count($heroes),
			  'pages'=>$pages,
			  'sort'=>$sort,
			  'playername'=>$playername,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Heroes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Heroes']))
			$model->attributes=$_GET['Heroes'];

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
		$model=Heroes::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='heroes-form')
		{
			echo CActiveForm::validate($model);
			app()->end();
		}
	}
}
