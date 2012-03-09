<?php

class GamesController extends Controller
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
		$commandBuilder = app()->db->getCommandBuilder();

		$model = Games::model();

		$gamesPerPage = param('gamesPerPage');
		
		$criteria = new CDbCriteria;
		$pages = new CPagination;
		$sort = new CSort;

		$cacheId = 'GamesIndex:'.$pages->getCurrentPage().':'.$sort->getOrderBy();

		if(!$data = app()->cache->get($cacheId)) {
			$criteria->addSearchCondition('map','dota');// generates map LIKE '%dota%'

			$count = $model->count($criteria);

			$pages->setItemCount($count);
			$pages->setPageSize($gamesPerPage);
			$pages->pageVar = 'page';

			$sort->defaultOrder = 'id';
			$sort->attributes = array(
				'game' => 'LOWER(gamename)',
				'duration' => 'duration',
				'type' => 'gamestate',
				'date' => 'datetime',
				'creator' => 'LOWER(creatorname)'
			);

			$criteria->select="gamestate,
				g.id, map, datetime, gamename,
				ownername, duration, creatorname, dg.winner";

			$criteria->alias="g";
			$criteria->join="LEFT JOIN dotagames AS dg ON g.id = dg.gameid";

			//apply sorting and pages to criteria
			$sort->applyOrder($criteria);
			$pages->applyLimit($criteria);

			$command = $commandBuilder->createFindCommand('games',$criteria,'g');

			$games = $command->queryAll();

			$data = array(
			 'games'=>$games,
			 'gamesCount'=>$count,
			 'pages'=>$pages,
			 'sort'=>$sort,
			);

            app()->cache->set($cacheId, $data,param('pageCacheTime'));
		}

		$this->render('index',$data);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $data=array();
        $model = Games::model();

		$cacheId = 'GamesView:'.$id;
		//if(!$data = app()->cache->get($cacheId)) {

			$gameInfo = $model->findInfoByPk($id)->find();//$command->queryRow();

            $gameStats = $model->findStatsByPk($id)->findAll();
			$data['gameInfo']=$gameInfo;
            $data['gameStats']=$gameStats;

			//app()->cache->set($cacheId, $data, param('pageCacheTime'));
		//}
        $data['model']=$model;
		$this->render('view', $data);
	}
}