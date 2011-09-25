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