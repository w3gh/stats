<?php

/**
 * This is the model class for table "bots".
 *
 * The followings are the available columns in table 'bots':
 * @property integer $id
 * @property integer $serversid
 * @property integer $botid
 * @property string $name
 * @property string $ip
 * @property integer $port
 */
class Bots extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Bots the static model class
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
		return 'bots';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serversid, botid, name, ip, port', 'required'),
			array('serversid, botid, port', 'numerical', 'integerOnly'=>true),
			array('name, ip', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, serversid, botid, name, ip, port', 'safe', 'on'=>'search'),
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
			'serversid' => 'Serversid',
			'botid' => 'Botid',
			'name' => 'Name',
			'ip' => 'Ip',
			'port' => 'Port',
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
		$criteria->compare('serversid',$this->serversid);
		$criteria->compare('botid',$this->botid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('port',$this->port);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}