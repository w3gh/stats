<?php

class PlayersController extends PublicController
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

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionView($id)
	{

		$gamesPerPage = param('gamesPerPage');
		$minPlayedRatio = param('minPlayedRatio');
		
		$commandBuilder = app()->db->getCommandBuilder();
		
		$sql = "
			SELECT
			gp.name AS name,
			bans.name AS banname,
			admins.name AS adminname,
			bans.reason AS banreason,
			count(1) AS counttimes,
			gp.ip AS ip
			FROM gameplayers AS gp
		  	JOIN dotaplayers AS dp ON dp.colour = gp.colour AND dp.gameid = gp.gameid
				LEFT JOIN bans ON bans.name = gp.name
				LEFT JOIN admins ON admins.name = gp.name
			WHERE	LOWER(gp.name) = LOWER(:username) GROUP BY gp.name
			ORDER BY counttimes DESC, gp.name ASC";

		$command = $commandBuilder->createSqlCommand($sql,array(':username'=>$id));

		$sqlCount = "
			SELECT COUNT(*) AS count
			FROM dotaplayers AS dp
			LEFT JOIN gameplayers AS gp ON gp.gameid = dp.gameid AND dp.colour = gp.colour
			LEFT JOIN heroes AS e ON dp.hero = heroid
			WHERE LOWER(name) = LOWER(:username) AND original <> 'NULL'
			LIMIT 1";
		$command = $commandBuilder->createSqlCommand($sqlCount,array(':username'=>$id));
		$row = $command->query()->read();
		
		$pages = new CPagination($row['count']);
		$pages->setPageSize($gamesPerPage);
		
		$sort = new CSort();
		$sort->defaultOrder = 'g.id';
		$sort->attributes = array(
			'game'=>'LOWER(gamename)',
			'hero'=>'description',
			'type'=>'type',
			'date'=>'datetime',
			'kills'=>'kills',
			'deaths'=>'deaths',
			'assists'=>'assists',
			'ratio'=>'kdratio',
			'creeps'=>'creepkills',
			'denies'=>'creepdenies',
			'neutral'=>'neutralkills',
			'result'=>'outcome',
		);
		$sql = "
			SELECT
				winner,
				dp.gameid AS id,
				newcolour,
				datetime,
				gamename,
				original,
				description,
				kills,
				deaths,
				assists,
				creepkills,
				creepdenies,
				neutralkills,
				name,
				CASE WHEN(gamestate = '17')
					THEN :priv ELSE :pub END AS type,
				CASE WHEN (kills = 0)
					THEN 0 WHEN (deaths = 0)
					THEN 1000 ELSE (kills*1.0/deaths) END AS kdratio,
				CASE WHEN ((winner=1 AND newcolour < 6)
					OR (winner=2 AND newcolour > 5))
					AND gp.`left`/g.duration >= :minPlayedRatio
						THEN :won WHEN ((winner=2 AND newcolour < 6)
					OR (winner=1 AND newcolour > 5))
					AND gp.`left`/g.duration >= :minPlayedRatio
						THEN :lost WHEN  winner=0
							THEN :draw ELSE :leaver END AS outcome
			FROM dotaplayers AS dp
			LEFT JOIN gameplayers AS gp ON gp.gameid = dp.gameid AND dp.colour = gp.colour
			LEFT JOIN dotagames AS dg ON dg.gameid = dp.gameid
			LEFT JOIN games AS g ON g.id = dp.gameid
			LEFT JOIN heroes AS e ON dp.hero = heroid
			WHERE LOWER(name) = LOWER(:username) AND original <> 'NULL'
			ORDER BY :sort
			LIMIT :offset, :limit";

		$command = $commandBuilder->createSqlCommand($sql,array(
						':minPlayedRatio'=>$minPlayedRatio,
						':pub'=>__('app','Public'),
						':priv'=>__('app','Private'),
						':won'=>__('app','Won'),
						':lost'=>__('app','Lost'),
						':draw'=>__('app','Draw'),
						':leaver'=>__('app','Leaver'),
						':username'=>$id,
						':sort'=>$sort->getOrderBy(),
						':offset'=>$pages->getOffset(),
						':limit'=>$pages->getLimit(),
		));
		$games = $command->queryAll();
		$this->render('view',array(
				                    'id'=>$id,
			                      'games'=>$games,
			                      'pages'=>$pages,
			                      'sort'=>$sort,
			                     ));
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