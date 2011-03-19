<?php

/**
 * This is the model class for table "gameplayers".
 *
 * The followings are the available columns in table 'gameplayers':
 * @property integer $id
 * @property integer $botid
 * @property integer $gameid
 * @property string $name
 * @property string $ip
 * @property integer $spoofed
 * @property integer $reserved
 * @property integer $loadingtime
 * @property integer $left
 * @property string $leftreason
 * @property integer $team
 * @property integer $colour
 * @property string $spoofedrealm
 *
 * The followings are the available model relations:
 */
class Players extends CActiveRecord
{
  public  $totgames,
          $kills,
          $deaths,
          $assists,
          $creepkills,
          $creepdenies,
          $neutralkills,
          $towerkills,
          $lastplayed,
          $firstplayed,
          $isbanned,
          $name,
          $isadmin,
          $server,
          $servername,
          $serverid,
          $secondsplayed,
          $win,
          $loss,
          $team,
          $count,
          $hero, $heroname, $herooriginal, $herodesc, $herostats, $heroskills,
          $gamestate, $winner, $gamename, $map, $duration, $date, $boname, $boid;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Gameplayers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gameplayers';
	}

  public function getPrimaryKey()
  {
    return 'name';
  }

  /**
   *
   * @return array default criteria rules
   */
  public function  defaultScope()
  {
    return array(
        'select'=>'gp.name AS name',
        'alias'=>'gp',
    );
  }

  public function scopes()
  {
    return array(

        //Preset for grouping players
        'byplayer'=>array(
            'group'=>'gp.name',
        ),
        //Preset for Selecting One Player
        'player'=>array( // used in players/player action
            'select'=>array(
              'gp.name AS name',
              'COUNT(*) AS totgames',
              'gp.gameid AS gameid',
              'gp.colour AS colour',
              'AVG(dp.courierkills) AS courierkills',
              'AVG(dp.raxkills) AS raxkills',
              'AVG(dp.towerkills) AS towerkills',
              'AVG(dp.assists) AS assists',
              'AVG(dp.creepdenies) AS creepdenies',
              'AVG(dp.creepkills) AS creepkills',
              'AVG(dp.neutralkills) AS neutralkills',
              'AVG(dp.deaths) AS deaths',
              'AVG(dp.kills) AS kills',
              'SUM(CASE WHEN(((dg.winner = 1 AND dp.newcolour < 6) OR (dg.winner = 2 and dp.newcolour > 6)) AND gp.`left`/ga.duration >= 0.8) THEN 1 ELSE 0 END) AS wins',
              'SUM(CASE WHEN(((dg.winner = 2 AND dp.newcolour < 6) OR (dg.winner = 1 and dp.newcolour > 6)) AND gp.`left`/ga.duration >= 0.8) THEN 1 ELSE 0 END) AS losses',
              'SUM(dp.kills) AS sumKills',
              'SUM(dp.deaths) AS sumDeaths',
              'SUM(dp.creepkills) AS sumCreepkills',
              'SUM(dp.creepdenies) AS sumCreepdenies',
              'SUM(dp.assists) AS sumAssists',
              'SUM(dp.neutralkills) AS sumNeutralkills',
              'SUM(dp.towerkills) AS sumTowerkills',
              'SUM(dp.raxkills) AS sumRaxkills',
              'SUM(dp.courierkills) AS sumCourierkills',
              's.server AS server',
              's.id AS serverid',
              's.name AS servername',
            ),
            'join'=>implode(' ',array(
              'LEFT JOIN dotagames AS dg ON gp.gameid = dg.gameid',
              'LEFT JOIN games AS ga ON ga.id = dg.gameid',
              'LEFT JOIN dotaplayers AS dp ON dp.gameid = dg.gameid AND gp.colour = dp.colour',
              'LEFT JOIN servers AS s ON gp.spoofedrealm = s.server',
              'LEFT JOIN bots AS bo ON gp.botid = bo.botid',
            )),
            'condition'=>'dg.winner <> 0',
            'group'=>'gp.name',
            'order'=>'totgames DESC',
        ),

        //Preset for including DotA Information
        'dota'=>array(
            'select'=>array(
              'COUNT(dg.id) AS totgames',
              'ROUND(AVG(dp.kills),0) AS kills',
              'ROUND(AVG(dp.deaths),0) AS deaths',
              'ROUND(AVG(dp.assists),0) AS assists',
              'ROUND(AVG(dp.creepkills),0) AS creepkills',
              'ROUND(AVG(dp.creepdenies),0) AS creepdenies',
              'ROUND(AVG(dp.neutralkills),0) AS neutralkills',
              'ROUND(AVG(dp.towerkills),0) AS towerkills',
              'DATE_FORMAT(MAX(g.datetime),"%d %m %Y") AS lastplayed',
              'DATE_FORMAT(MIN(g.datetime),"%d %m %Y") AS firstplayed',
              's.server AS server',
              's.id AS serverid',
              's.name AS servername',

            ),
            'join'=>'
              INNER JOIN dotaplayers AS dp USING (colour, gameid)
              LEFT JOIN dotagames AS dg ON dp.gameid = dg.gameid
              LEFT JOIN games AS g ON g.id = dg.gameid
              LEFT JOIN servers AS s ON gp.spoofedrealm = s.server
              LEFT JOIN bots AS bo ON gp.botid = bo.botid',
            'condition'=>"gp.name <> '' AND dg.winner <> 0",
            'order'=>'totgames DESC'
        ),
      //Preset for including information about Ban
        'bans'=>array(
            'select'=>array(
              'b.name IS NOT NULL AS isbanned',
            ),
            'join'=>'LEFT JOIN bans AS b ON b.name = gp.name',
        ),
      //Preset for including information about Admin
        'admins'=>array(
            'select'=>array(
                'a.name IS NOT NULL AS isadmin'
            ),
            'join'=>'LEFT JOIN admins AS a ON a.name = gp.name',
        ),
      //Preset for selecting Server List
        'servers'=>array(
          'select'=>'spoofedrealm AS server',
          'group'=>'spoofedrealm',
          'order'=>'spoofedrealm',
          'condition'=>"spoofedrealm <> ''"
        ),

        //Preset for selecting unranked players list for Elo Rank Method
        'unrankedPlayers'=>array(
          'select'=>array(
            'gp.name',
            'gp.team AS team',
            '(CASE dg.winner WHEN (gp.team + 1) THEN 1 ELSE 0 END) as win',
            '(CASE dg.winner WHEN (gp.team + 1) THEN 0 ELSE 1 END) as loss',
            'gp.id',
            'gp.spoofedrealm as server',
            'dp.kills as kills',
            'dp.deaths as deaths',
            'dp.assists as assists',
            'dp.creepkills as creepkills',
            'dp.creepdenies as creepdenies',
            'dp.neutralkills as neutralkills',
            'gp.`left` as secondsplayed'
          ),
          'join'=>'INNER JOIN dotaplayers AS dp ON dp.gameid = gp.gameid AND dp.newcolour = gp.colour
                   INNER JOIN dotagames AS dg ON dp.gameid = dg.gameid
                   INNER JOIN games AS g ON dp.gameid = g.id',
          'condition'=>'dg.winner <> 0'
        ),

        //Preset for selecting Hero list by One Player
        'heroes'=>array(
          'select'=>array(
            'COUNT(*) AS totgames',
            'dp.hero AS hero',
            'h.description AS heroname',
            'h.original AS herooriginal',
            'h.summary AS herodesc',
            'h.stats AS heroskills',
            'h.skills AS herostats',
            'SUM(CASE WHEN (((dg.winner = 1 AND dp.newcolour < 6) OR (dg.winner = 2 AND dp.newcolour > 6)) ) THEN 1 ELSE 0 END) AS win',
            'SUM(CASE WHEN (((dg.winner = 1 AND dp.newcolour > 6) OR (dg.winner = 2 AND dp.newcolour < 6)) ) THEN 1 ELSE 0 END) AS loss',
            'ROUND(AVG(dp.kills),0) AS kills',
            'ROUND(AVG(dp.deaths),0) AS deaths',
            'ROUND(AVG(dp.assists),0) AS assists',
            'ROUND(AVG(dp.creepkills),0) AS creepkills',
            'ROUND(AVG(dp.creepdenies),0) AS creepdenies',
            'ROUND(AVG(dp.neutralkills),0) AS neutralkills',
            'ROUND(AVG(dp.towerkills),0) AS towerkills',
            's.server AS server',
            's.id AS serverid',
            's.name AS servername',
          ),
          'join'=>implode(' ', array(
            'INNER JOIN dotaplayers AS dp ON dp.gameid = gp.gameid AND dp.newcolour = gp.colour',
            'INNER JOIN dotagames AS dg ON dp.gameid = dg.gameid',
            'LEFT JOIN heroes AS h ON hero = heroid',
            'LEFT JOIN servers AS s ON gp.spoofedrealm = s.server',
            'LEFT JOIN bots AS bo ON gp.botid = bo.botid',
          )),
          'condition'=>"dg.winner <> 0",
          'group'=>'h.original',
          'order'=>'totgames DESC'
        ),
        'games'=>array(
          'select'=>array(
            'g.id AS id',
            'dg.winner AS winner',
            'g.map AS map',
            'g.botid AS botid',
            'g.server AS server',
            'g.datetime AS datetime',
            'DATE_FORMAT(g.datetime,"%d %m %Y") AS date',
            'g.gamename AS gamename',
            'g.ownername AS name',
            'g.duration AS duration',
            'g.gamestate AS gamestate',
            'g.creatorname AS creatorname',
            'g.creatorserver AS creatorserver',
            's.name AS servername',
            's.id AS serverid',
            'bo.name AS boname',
            'bo.id AS boid',
            'dp.hero AS hero',
            'h.description AS heroname',
            'h.original AS herooriginal',
            'h.summary AS herodesc',
            'h.stats AS heroskills',
            'h.skills AS herostats',
          ),
          
          'join'=>implode(' ', array(
            'INNER JOIN games AS g ON g.id = gp.gameid',
            'INNER JOIN dotaplayers AS dp ON dp.gameid = gp.gameid AND dp.newcolour = gp.colour',
            'INNER JOIN dotagames AS dg ON g.id = dg.gameid',
            'LEFT JOIN heroes AS h ON hero = heroid',
            'LEFT JOIN servers AS s ON g.creatorserver = s.server',
            'LEFT JOIN bots AS bo ON g.botid = bo.botid',
          )),
          'condition'=>"g.map LIKE '%dota%' AND s.id = bo.serversid",
          'group'=>'g.id, h.original',
          'order'=>'g.datetime DESC',
        ),
    );
  }

  /**
   * Count Players including scopes
   * @param mixed $condition
   * @param array $params
   * @return int
   */
  public function countPlayers($condition='', $params=array())
  {
    $criteria=new CDbCriteria();
    $scopes=$this->scopes();
    $criteria->mergeWith($scopes['dota']);
    $criteria->select="COUNT( DISTINCT ".$this->tableAlias.".".$this->primaryKey." ) AS count";
    $criteria->order=$criteria->group='';

    $this->getDbCriteria()->mergeWith($criteria);
    $row = self::model()->find($condition, $params);

    return $row->count;
  }

  /**
   * Find One Player
   * @param string $name player name
   * @param string $server server name
   * @return mixed player data
   */
  public function findPlayer($name,$server)
  {
    $criteria=new CDbCriteria;
    $criteria->condition='s.id = :server AND gp.name = :name';
    $criteria->params=array(':server'=>$server, ':name'=>$name);
    $criteria->order='s.server';
    $criteria->limit=1;

    return $this->player()->find($criteria);
  }

  /**
   * Find all heroes depending on player and server
   * @param string $name Player name
   * @param string $server Server 
   */
  public function findHeroes($name,$server)
  {
    $criteria=new CDbCriteria;
    $criteria->condition='s.id = :server AND gp.name = :name';
    $criteria->params=array(':server'=>$server, ':name'=>$name);
    $criteria->order='s.server';

    return $this->heroes()->findAll($criteria);
  }

  /**
   * Find all games depending on player and server
   * @param string $name Player name
   * @param string $server Server
   */
  public function findGames($name,$server)
  {
    $criteria=new CDbCriteria;
    $criteria->condition='s.id = :server AND gp.name = :name';
    $criteria->params=array(':server'=>$server, ':name'=>$name);

    return $this->games()->findAll($criteria);
  }


  /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('botid, gameid, name, ip, spoofed, reserved, loadingtime, left, leftreason, team, colour, spoofedrealm', 'required'),
			array('botid, gameid, spoofed, reserved, loadingtime, left, team, colour', 'numerical', 'integerOnly'=>true),
			array('name, ip', 'length', 'max'=>15),
			array('leftreason, spoofedrealm', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, botid, gameid, name, ip, spoofed, reserved, loadingtime, left, leftreason, team, colour, spoofedrealm', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'botid' => 'Botid',
			'gameid' => 'Gameid',
			'name' => 'Name',
			'ip' => 'Ip',
			'spoofed' => 'Spoofed',
			'reserved' => 'Reserved',
			'loadingtime' => 'Loadingtime',
			'left' => 'Left',
			'leftreason' => 'Leftreason',
			'team' => 'Team',
			'colour' => 'Colour',
			'spoofedrealm' => 'Spoofedrealm',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('botid',$this->botid);
		$criteria->compare('gameid',$this->gameid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('spoofed',$this->spoofed);
		$criteria->compare('reserved',$this->reserved);
		$criteria->compare('loadingtime',$this->loadingtime);
		$criteria->compare('left',$this->left);
		$criteria->compare('leftreason',$this->leftreason,true);
		$criteria->compare('team',$this->team);
		$criteria->compare('colour',$this->colour);
		$criteria->compare('spoofedrealm',$this->spoofedrealm,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}