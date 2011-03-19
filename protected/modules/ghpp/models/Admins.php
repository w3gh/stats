<?php

/**
 * This is the model class for table "admins".
 *
 * The followings are the available columns in table 'admins':
 * @property integer $id
 * @property integer $botid
 * @property string $name
 * @property string $server
 *
 * The followings are the available model relations:
 */
class Admins extends CActiveRecord
{

  public $servername, $serverid,
         $boname,
         $gameshosted,
         $banscount;

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
			array('botid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>15),
			array('server', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, botid, name, server', 'safe', 'on'=>'search'),
		);
	}

  public function  defaultScope() {
    return array(
	     'select'=>array(
          'a.id AS id',
          'a.name AS name',
          'a.server AS server',
          'a.botid AS botid',
          's.name AS servername',
          's.id AS serverid',
          'bo.name AS boname',
          'bo.id AS boid',
      ),
      'condition'=>'s.id = bo.serversid',
      'join'=>'LEFT JOIN servers AS s ON a.server = s.server LEFT JOIN bots AS bo ON a.botid = bo.botid',
      'order'=>'a.botid,a.server DESC',
      'alias'=>'a',
    );
  }

  public function  scopes() {
    return array(
        'servers'=>array(
          'select'=>'a.server',
          'group'=>'a.server',
          'order'=>'a.server',
          'condition'=>"a.server <> ''"
        ),
        'gameshosted'=>array(
            'select'=>'(SELECT count(*) FROM games AS g WHERE g.ownername = a.name) AS gameshosted'
        ),
        'banscount'=>array(
            'select'=>'(SELECT count(*) FROM bans AS b WHERE b.admin = a.name) AS banscount'
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

		$criteria->compare('a.id',$this->id);
		$criteria->compare('a.botid',$this->botid);
		$criteria->compare('a.name',$this->name,true);
		$criteria->compare('a.server',$this->server,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}