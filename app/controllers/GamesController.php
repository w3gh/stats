<?php

class GamesController extends PublicController
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
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

		$request = app()->request;
		$model = Games::model();
		$gamesPerPage = param('gamesPerPage');

		$criteria = new CDbCriteria;

		$criteria->addSearchCondition('map','dota');// generates map LIKE '%dota%'

		$year = $request->getParam('year', FALSE);
		$month = $request->getParam('month', FALSE);
		$day = $request->getParam('day', FALSE);

		if($year){
			$criteria->addCondition('YEAR(datetime) = :year');
			$criteria->params[':year']=$year;
		}
		if($month){
			$criteria->addCondition('MONTH(datetime) = :month');
			$criteria->params[':month']=$month;
		}
		if($day){
			$criteria->addCondition('DAYOFMONTH(datetime) = :day');
			$criteria->params[':day']=$day;
		}

		$count = $model->count($criteria);

		$pages = new CPagination;
		$pages->setItemCount($count);
		$pages->setPageSize($gamesPerPage);
		$pages->pageVar = 'page';
		
		$sort = new CSort;
		$sort->defaultOrder = 'id';
		$sort->attributes = array(
			'game' => 'LOWER(gamename)',
			'duration' => 'duration',
			'type' => 'type',
			'date' => 'datetime',
			'creator' => 'LOWER(creatorname)'
		);

		$criteria->select="CASE WHEN(gamestate = '17') THEN :priv ELSE :pub END AS type,
			g.id, map, datetime, gamename,
			ownername, duration, creatorname, dg.winner";

		$criteria->alias="g";
		$criteria->join="LEFT JOIN dotagames AS dg ON g.id = dg.gameid";

		//apply sorting and pages to criteria
		$sort->applyOrder($criteria);
		$pages->applyLimit($criteria);
		
		$criteria->params[':pub']=__('app','Public');
		$criteria->params[':priv']=__('app','Private');
		
		$commandBuilder = app()->db->getCommandBuilder();
		$command = $commandBuilder->createFindCommand('games',$criteria,'g');

		$games = $command->queryAll();

		$this->render('index',array(
			                     'games'=>$games,
			                     'gamesCount'=>$count,
			                     'pages'=>$pages,
			                     'sort'=>$sort,
		                      ));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$commandBuilder = app()->db->getCommandBuilder();
		
		$sql = "
			SELECT
				winner, creatorname, duration, datetime, gamename
			FROM dotagames AS dg
				LEFT JOIN games AS d ON d.id = dg.gameid
			WHERE dg.gameid= :gid";

		$command = $commandBuilder->createSqlCommand($sql,array(':gid'=>$id));
		$gameInfo = $command->queryRow();

		$sql = "
		SELECT
			winner,
			dp.gameid,
			gp.colour,
			newcolour,
			original AS hero,
			description,
			kills,
			deaths,
			assists,
			creepkills,
			creepdenies,
			neutralkills,
			towerkills,
			gold,
			raxkills,
			courierkills,
			item1,
			item2,
			item3,
			item4,
			item5,
			item6,
			it1.icon AS itemicon1,
			it2.icon AS itemicon2,
			it3.icon AS itemicon3,
			it4.icon AS itemicon4,
			it5.icon AS itemicon5,
			it6.icon AS itemicon6,
			it1.name AS itemname1,
			it2.name AS itemname2,
			it3.name AS itemname3,
			it4.name AS itemname4,
			it5.name AS itemname5,
			it6.name AS itemname6,
			leftreason,
			gp.left,
			gp.name AS name,
			gp.spoofedrealm AS server,
			gp.ip AS ip,
			b.name AS banname,
			a.name AS adminname
		FROM dotaplayers AS dp
		LEFT JOIN gameplayers AS gp ON gp.gameid = dp.gameid AND dp.colour = gp.colour
		LEFT JOIN dotagames AS dg ON dg.gameid = dp.gameid
		LEFT JOIN games AS g ON g.id = dp.gameid
		LEFT JOIN bans AS b ON b.name=gp.name
		LEFT JOIN admins AS a ON a.name=gp.name
		LEFT JOIN heroes AS f ON hero = heroid
		LEFT JOIN items AS it1 ON it1.itemid = item1
		LEFT JOIN items AS it2 ON it2.itemid = item2
		LEFT JOIN items AS it3 ON it3.itemid = item3
		LEFT JOIN items AS it4 ON it4.itemid = item4
		LEFT JOIN items AS it5 ON it5.itemid = item5
		LEFT JOIN items AS it6 ON it6.itemid = item6
		WHERE dp.gameid=:gid
		GROUP BY gp.name
	  ORDER BY newcolour";

		$command = $commandBuilder->createSqlCommand($sql,array(':gid'=>$id));
		$gameStats = $command->queryAll();
		
		$this->render('view', array(
		              'gameInfo'=>$gameInfo,
									'gameStats'=>$gameStats));
	}
}