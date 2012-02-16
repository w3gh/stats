<?php

/**
 * This is the model class for table "safelist".
 *
 * The followings are the available columns in table 'safelist':
 * @property integer $id
 * @property string $server
 * @property string $name
 * @property string $voucher
 */
class Safelist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Safelist the static model class
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
		return 'safelist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('server, name', 'required'),
			array('server', 'length', 'max'=>100),
			array('name, voucher', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, server, name, voucher', 'safe', 'on'=>'search'),
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
			'server' => 'Server',
			'name' => 'Name',
			'voucher' => 'Voucher',
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
		$criteria->compare('server',$this->server,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('voucher',$this->voucher,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}