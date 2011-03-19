<?php

class Players extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'gameplayers':
	 * @var integer $id
	 * @var integer $botid
	 * @var integer $gameid
	 * @var string $name
	 * @var string $ip
	 * @var integer $spoofed
	 * @var integer $reserved
	 * @var integer $loadingtime
	 * @var integer $left
	 * @var string $leftreason
	 * @var integer $team
	 * @var integer $colour
	 * @var string $spoofedrealm
	 */

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
		return 'gameplayers';
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
		);
	}

  public function defaultScope()
	{
    /*
      SELECT
      COUNT(a.id) as totgames,
      AVG(kills) as kills,
      AVG(deaths) as deaths,
      AVG(assists) as assists,
      AVG(creepkills) as creepkills,
      AVG(creepdenies) as creepdenies,
      AVG(neutralkills) as neutralkills,
      AVG(towerkills) as towerkills,
      MAX(datetime) as lastplayed,
      MIN(datetime) as firstplayed,
      b.name as name, e.name as banname
FROM dotaplayers AS a
LEFT JOIN gameplayers AS b ON b.gameid = a.gameid and a.colour = b.colour
LEFT JOIN dotagames AS c ON c.gameid = a.gameid
LEFT JOIN games as d ON d.id = c.gameid
LEFT JOIN bans AS e on b.name = e.name
where b.name <> '' and winner <> 0
     */
    return array(
      'join'=>'
          LEFT JOIN dotaplayers AS dp ON gp.gameid = dp.gameid AND dp.colour = gp.colour
          LEFT JOIN dotagames AS dg ON dg.gameid = gp.gameid
          LEFT JOIN games AS ga ON ga.id = dg.gameid
          LEFT JOIN bans AS b on gp.name = b.name',
       'group'=>'gp.name',
       'alias'=>'gp',
    );
  }

	public function scopes()
	{
    return array(

        'pubs'=>array('condition'=>"gamestate = '16'"),
        'privs'=>array('condition'=>"gamestate = '17'"),
        'published'=>array(
              'condition'=>'spoofed=1',
        ),
        'recently'=>array(
              'order'=>'createTime DESC',
              'limit'=>5,
        ),
    );
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

	public function getPrimaryKey()
	{
	  return 'gameid';
	}


	/*
	 * EVENTS
	 */

	public function beforeFind()
	{
		parent::beforeFind();
	}
}