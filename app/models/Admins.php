<?php

/**
 * This is the model class for table "admins".
 *
 * The followings are the available columns in table 'admins':
 * @property string $id
 * @property string $botid
 * @property string $name
 * @property string $server
 */
class Admins extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Admins the static model class
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
		return 'admins';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('botid, name, server', 'required'),
			array('botid', 'length', 'max'=>10),
			array('name', 'length', 'max'=>15),
			array('server', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, botid, name, server', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'server' => 'Server',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('server',$this->server,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}