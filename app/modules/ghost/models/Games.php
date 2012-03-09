<?php

/**
 * This is the model class for table "games".
 *
 * The followings are the available columns in table 'games':
 * @property string $id
 * @property string $botid
 * @property string $server
 * @property string $map
 * @property string $datetime
 * @property string $gamename
 * @property string $ownername
 * @property integer $duration
 * @property integer $gamestate
 * @property string $creatorname
 * @property string $creatorserver
 */
class Games extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Games the static model class
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

    public function behaviors()
    {
        return array(
            'commentable' => array(
                'class' => 'application.modules.comment.behaviors.CommentableBehavior',
                //'mapType' => 'games',
            ),
        );
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
			array('duration, gamestate', 'numerical', 'integerOnly'=>true),
			array('botid', 'length', 'max'=>10),
			array('server, map, creatorserver', 'length', 'max'=>100),
			array('gamename', 'length', 'max'=>31),
			array('ownername, creatorname', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, botid, server, map, datetime, gamename, ownername, duration, gamestate, creatorname, creatorserver', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'botid' => 'Bot ID',
			'server' => 'Server',
			'map' => 'Map',
			'datetime' => 'Datetime',
			'gamename' => 'Game Name',
			'ownername' => 'Owner Name',
			'duration' => 'Duration',
			'gamestate' => 'Game State',
			'creatorname' => 'Creator Name',
			'creatorserver' => 'Creator Server',
		);
	}

    public $winner;

    public function findInfoByPk($gid = false)
    {
        if($gid == false)
            return $this;

        $criteria = new CDbCriteria();
        $criteria->select='dg.winner AS winner, creatorname, duration, datetime, gamename';
        $criteria->join='LEFT JOIN dotagames AS dg ON t.id = dg.gameid';
        $criteria->condition='dg.gameid= :gid';
        $criteria->params=array(':gid'=>(int)$gid);

        $this->getDbCriteria()->mergeWith($criteria);

        return $this;
    }

    public $kills,$deaths,$assists,$creepkills,$creepdenies,$neutralkills,
        $towerkills,$raxkills,$courierkills,$gold,$left,$leftreason,$hero,
        $description,$name,$newcolour,$gameid,$banname,$itemicon1,$itemicon2,$itemicon3,$itemicon4,
        $itemicon5,$itemicon6,$item1,$item2,$item3,$item4,$item5,$item6,$adminname;

    public function findStatsByPk($gid = false)
    {
        if($gid == false)
            return $this;

        $criteria = new CDbCriteria();
        $criteria->select='
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
        ';
        $criteria->condition='dp.gameid=:gid';
        $criteria->params=array(':gid'=>$gid);
        $criteria->order='newcolour';
        $criteria->group='gp.name';
        $criteria->join='
     			LEFT JOIN dotaplayers AS dp ON t.id = dp.gameid
     			LEFT JOIN gameplayers AS gp ON gp.gameid = t.id AND dp.colour = gp.colour
     			LEFT JOIN dotagames AS dg ON dg.gameid = dp.gameid
     			LEFT JOIN bans AS b ON b.name=gp.name
     			LEFT JOIN admins AS a ON a.name=gp.name
     			LEFT JOIN heroes AS f ON hero = heroid
     			LEFT JOIN items AS it1 ON it1.itemid = item1
     			LEFT JOIN items AS it2 ON it2.itemid = item2
     			LEFT JOIN items AS it3 ON it3.itemid = item3
     			LEFT JOIN items AS it4 ON it4.itemid = item4
     			LEFT JOIN items AS it5 ON it5.itemid = item5
     			LEFT JOIN items AS it6 ON it6.itemid = item6
        ';


        $this->getDbCriteria()->mergeWith($criteria);

        return $this;
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('botid',$this->botid,true);
		$criteria->compare('server',$this->server,true);
		$criteria->compare('map',$this->map,true);
		$criteria->compare('datetime',$this->datetime,true);
		$criteria->compare('gamename',$this->gamename,true);
		$criteria->compare('ownername',$this->ownername,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('gamestate',$this->gamestate);
		$criteria->compare('creatorname',$this->creatorname,true);
		$criteria->compare('creatorserver',$this->creatorserver,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}