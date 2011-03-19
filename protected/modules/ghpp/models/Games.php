<?php

class Games extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'games':
	 * @var integer $id
	 * @var integer $botid
	 * @var string $server
	 * @var string $map
	 * @var string $datetime
	 * @var string $gamename
	 * @var string $ownername
	 * @var integer $duration
	 * @var integer $gamestate
	 * @var string $creatorname
	 * @var string $creatorserver
	 */

  public $servername,
         $boname,
         $serverid,
         $boid,
         $name,
         $winner,
         $isbanned,
         $isadmin,
         $date,
         $team,
         $newcolour,
          $kills, $deaths, $assists, $creepkills, $creepdenies, $neutralkills, $towerkills, $gold, 
          $item1, $item2, $item3, $item4,
          $hero, $heroname, $herooriginal, $herodesc, $heroskills, $herostats,
         $left, $leftreason, $server;

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return 'games';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('botid, server, map, datetime, gamename, ownername, duration, gamestate, creatorname, creatorserver', 'required'),
			array('botid, duration, gamestate', 'numerical', 'integerOnly'=>true),
			array('server, map, creatorserver', 'length', 'max'=>100),
			array('gamename', 'length', 'max'=>31),
			array('ownername, creatorname', 'length', 'max'=>15),
		);
	}

  public function  defaultScope() {
    return array(
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
        ),
        'alias'=>'g',
        'condition'=>"g.map LIKE '%dota%' AND s.id = bo.serversid",
        'join'=>'INNER JOIN dotagames AS dg ON g.id = dg.gameid LEFT JOIN servers AS s ON g.creatorserver = s.server LEFT JOIN bots AS bo ON g.botid = bo.botid',
        'order'=>'g.datetime DESC',
    );
  }

  public function  scopes() {
    return array(
        'unrankedGames'=>array(
            'join'=>'INNER JOIN dotagames AS dg ON g.id = dg.gameid',
            'condition'=>'dg.winner > 0 AND g.gamestate < 17',
            'order'=>'g.datetime ASC',
        ),
        'bans'=>array(
            'select'=>array(
              'b.name IS NOT NULL AS isbanned',
            ),
            'join'=>'LEFT JOIN bans AS b ON b.name = g.ownername',
        ),
        'admins'=>array(
            'select'=>array(
                'a.name IS NOT NULL AS isadmin'
            ),
            'join'=>'LEFT JOIN admins AS a ON a.name = g.ownername',
        ),
        'servers'=>array(
          'select'=>array(
            'g.creatorserver AS server',
            ),
          'condition'=>"g.creatorserver <> ''"
        ),
    );
  }

  public function findGame($gid=false)
  {
    if(!$gid) return $gid;

/*
 	   SELECT winner, dp.gameid, gp.colour, newcolour, original as hero, description, kills, deaths, assists, creepkills, creepdenies, neutralkills, towerkills, gold,  raxkills, courierkills,
	   item1, item2, item3, item4, item5, item6,
	   it1.icon as itemicon1,
	   it2.icon as itemicon2,
	   it3.icon as itemicon3,
	   it4.icon as itemicon4,
	   it5.icon as itemicon5,
	   it6.icon as itemicon6,
	   it1.name as itemname1,
	   it2.name as itemname2,
	   it3.name as itemname3,
	   it4.name as itemname4,
	   it5.name as itemname5,
	   it6.name as itemname6,
	   leftreason,
	   gp.left,
	   gp.name as name,
	   b.name as banname
	   FROM dotaplayers AS dp
	   LEFT JOIN gameplayers AS gp ON gp.gameid = dp.gameid and dp.colour = gp.colour
	   LEFT JOIN dotagames AS dg ON dg.gameid = dp.gameid
	   LEFT JOIN games AS g ON g.id = dp.gameid
	   LEFT JOIN bans as b ON gp.name = b.name
	   LEFT JOIN heroes as f ON hero = heroid
	   LEFT JOIN items as it1 ON it1.itemid = item1
	   LEFT JOIN items as it2 ON it2.itemid = item2
	   LEFT JOIN items as it3 ON it3.itemid = item3
	   LEFT JOIN items as it4 ON it4.itemid = item4
	   LEFT JOIN items as it5 ON it5.itemid = item5
	   LEFT JOIN items as it6 ON it6.itemid = item6
	   WHERE dp.gameid=$gid
	   ORDER BY newcolour";
 *     */

    $criteria=new CDbCriteria(array(

      'select'=>array(
        'winner',
        'dp.gameid',
        'gp.colour',
        'newcolour',
        'description',
        'kills',
        'deaths',
        'assists',
        'creepkills',
        'creepdenies',
        'neutralkills',
        'towerkills',
        'gold',
        'raxkills',
        'courierkills',
        'item1',
        'item2',
        'item3',
        'item4',
        'item5',
        'item6',
        'it1.icon as itemicon1',
        'it2.icon as itemicon2',
        'it3.icon as itemicon3',
        'it4.icon as itemicon4',
        'it5.icon as itemicon5',
        'it6.icon as itemicon6',
        'it1.name as itemname1',
        'it2.name as itemname2',
        'it3.name as itemname3',
        'it4.name as itemname4',
        'it5.name as itemname5',
        'it6.name as itemname6',
        'hero',
        'h.description AS heroname',
        'h.original AS herooriginal',
        'h.summary AS herodesc',
        'h.stats AS heroskills',
        'h.skills AS herostats',
        'leftreason',
        'gp.left',
        'gp.name AS name',
      ),
      'join'=>'
        LEFT JOIN dotaplayers AS dp ON g.id = dp.gameid
        LEFT JOIN gameplayers AS gp ON gp.gameid = dp.gameid and dp.colour = gp.colour
        LEFT JOIN heroes AS h ON hero = heroid
        LEFT JOIN items AS it1 ON it1.itemid = item1
        LEFT JOIN items AS it2 ON it2.itemid = item2
        LEFT JOIN items AS it3 ON it3.itemid = item3
        LEFT JOIN items AS it4 ON it4.itemid = item4
        LEFT JOIN items AS it5 ON it5.itemid = item5
        LEFT JOIN items AS it6 ON it6.itemid = item6',
      'condition'=>'dp.gameid=:gid',
      'params'=>array(':gid'=>$gid),
      'order'=>'dp.newcolour',
    ));

    $this->getDbCriteria()->mergeWith($criteria);

    return self::model()->bans()->admins()->findAll();
  }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'botid' => 'Botid',
			'server' => 'Server',
			'map' => 'Map',
			'datetime' => 'Datetime',
			'gamename' => 'Gamename',
			'ownername' => 'Ownername',
			'duration' => 'Duration',
			'gamestate' => 'Gamestate',
			'creatorname' => 'Creatorname',
			'creatorserver' => 'Creatorserver',
		);
	}
}