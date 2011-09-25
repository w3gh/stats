<?php

/**
 *
 */
class HeroGameHistory extends Portlet {

	public $heroId='';
	
	public $heroName='';

	protected $pages;

	protected $sort;

	protected $heroesCount;

	public function getHeroGameHistory() {
		$heroGameHistoryPerPage = param('heroGameHistoryPerPage');
		$minPlayedRatio = param('minPlayedRatio');
		$commandBuilder = app()->db->getCommandBuilder();

		$countSql = "
			SELECT COUNT(*) AS count
			FROM (
						 SELECT name
						 FROM dotaplayers AS dp
						 LEFT JOIN gameplayers AS gp ON gp.gameid = dp.gameid AND dp.colour = gp.colour
						 LEFT JOIN dotagames AS dg ON dg.gameid = dp.gameid
						 LEFT JOIN games AS g ON g.id = dp.gameid
						 LEFT JOIN heroes AS e ON dp.hero = heroid
						 WHERE heroid = :heroid
						 ) AS t LIMIT 1";
		
		$result = $commandBuilder
				->createSqlCommand($countSql,array(':heroid'=>$this->heroId))
				->query()
				->read();
		
		$pages = new CPagination($this->heroesCount = $result['count']);
		$pages->setPageSize($heroGameHistoryPerPage);

		$sort = new CSort();
		$sort->defaultOrder = 'kdratio';
		$sort->attributes = array(
			'player'=>'name',
			'game'=>'gamename',
			'type'=>'type',
			'result'=>'result',
			'kills'=>'kills',
			'deaths'=>'deaths',
			'assists'=>'assists',
			'kd'=>'kdratio',
			'creeps'=>'creepkills',
			'denies'=>'creepdenies',
			'neutrals'=>'neutralkills',
		);

	$sql = "
		SELECT
			CASE WHEN (kills = 0)
			 THEN 0 WHEN (deaths = 0)
			 THEN 1000 ELSE (kills*1.0/deaths*1.0) END AS kdratio,
			dp.gameid AS gameid,
			g.gamename,
			dg.winner,
			kills,
			deaths,
			assists,
			creepkills,
			neutralkills,
			creepdenies,
			towerkills,
			raxkills,
			courierkills,
			b.name AS name,
			b.ip AS ip,
			f.name AS banname,
			CASE WHEN(gamestate = '17') THEN :priv ELSE :pub END AS type,
			CASE WHEN ((winner=1 AND newcolour < 6)	OR (winner=2 AND newcolour > 5))
				AND b.`left`/g.duration >= :minPlayedRatio THEN :won WHEN ((winner=2 AND newcolour < 6) OR (winner=1 AND newcolour > 5))
				AND b.`left`/g.duration >= :minPlayedRatio THEN :lost WHEN  winner=0 THEN :draw ELSE :leaver END AS result
		FROM dotaplayers AS dp
		LEFT JOIN gameplayers AS b ON b.gameid = dp.gameid AND dp.colour = b.colour
		LEFT JOIN dotagames AS dg ON dg.gameid = dp.gameid
		LEFT JOIN games AS g ON g.id = dp.gameid
		LEFT JOIN heroes AS e ON dp.hero = heroid
		LEFT JOIN bans AS f ON b.name = f.name
		WHERE original = :heroid
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
																':heroid'=>$this->heroId,
			                          ':sort'=>$sort->getOrderBy(),
																':offset'=>$pages->getOffset(),
																':limit'=>$pages->getLimit(),
		                                                 ));
		$this->pages =& $pages;
		$this->sort =& $sort;
		return $command->queryAll();
	}
	
	public function renderContent() {
		$games = $this->getHeroGameHistory();
		return $this->render('heroGameHistory',array(
			                                      'games'=>$games,
			                                      'pages'=>$this->pages,
			                                      'sort'=>$this->sort,
			                                      'heroesCount'=>$this->heroesCount,
			                                      'heroName'=>$this->heroName,
		                                       ));
	}
}