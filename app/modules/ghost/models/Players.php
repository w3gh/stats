<?php

/**
 * This is the model class for table "players".
 *
 * The followings are the available columns in table 'players':
 * @property integer $id
 * @property integer $botid
 * @property string $server
 * @property string $name
 * @property integer $games
 * @property integer $wins
 * @property integer $looses
 * @property integer $kills
 * @property integer $deaths
 * @property integer $assists
 * @property integer $lastgame_id
 */
class Players extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Players the static model class
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
		return 'players';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('botid, server, name, games, wins, looses, kills, deaths, assists, lastgame_id', 'required'),
			array('botid, games, wins, looses, kills, deaths, assists, lastgame_id', 'numerical', 'integerOnly'=>true),
			array('server', 'length', 'max'=>100),
			array('name', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, botid, server, name, games, wins, looses, kills, deaths, assists, lastgame_id', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'games' => 'Games',
			'wins' => 'Wins',
			'looses' => 'Looses',
			'kills' => 'Kills',
			'deaths' => 'Deaths',
			'assists' => 'Assists',
			'lastgame_id' => 'Lastgame',
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
		$criteria->compare('server',$this->server,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('games',$this->games);
		$criteria->compare('wins',$this->wins);
		$criteria->compare('looses',$this->looses);
		$criteria->compare('kills',$this->kills);
		$criteria->compare('deaths',$this->deaths);
		$criteria->compare('assists',$this->assists);
		$criteria->compare('lastgame_id',$this->lastgame_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}