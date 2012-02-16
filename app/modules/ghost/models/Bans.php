<?php

/**
 * This is the model class for table "bans".
 *
 * The followings are the available columns in table 'bans':
 * @property string $id
 * @property string $botid
 * @property string $server
 * @property string $name
 * @property string $ip
 * @property string $date
 * @property string $gamename
 * @property string $admin
 * @property string $reason
 */
class Bans extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Bans the static model class
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
		return 'bans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('botid, server, name, ip, date, gamename, admin, reason', 'required'),
			array('botid', 'length', 'max'=>10),
			array('server', 'length', 'max'=>100),
			array('name, ip, admin', 'length', 'max'=>15),
			array('gamename', 'length', 'max'=>31),
			array('reason', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, botid, server, name, ip, date, gamename, admin, reason', 'safe', 'on'=>'search'),
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
			'ip' => 'Ip',
			'date' => 'Date',
			'gamename' => 'Gamename',
			'admin' => 'Admin',
			'reason' => 'Reason',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('gamename',$this->gamename,true);
		$criteria->compare('admin',$this->admin,true);
		$criteria->compare('reason',$this->reason,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}