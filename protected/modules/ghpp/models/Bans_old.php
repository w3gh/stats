<?php

/**
 * This is the model class for table "Bans".
 *
 * The followings are the available columns in table 'Bans':
 */
class Bans extends CActiveRecord
{
  
  public $day,$month,$year,$servername,$serverid,$boname,$boid,$datetime;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Bans the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	
	public function defaultScope() 
	{
	  return array(
	     'select'=>array(
          'b.name AS name', 
          'b.server AS server',
          'b.ip AS ip',
          'b.date AS datetime',
          'YEAR(b.date) AS year',
          'MONTH(b.date) AS month',
          'DAYOFMONTH(b.date) AS day',
          'b.gamename AS gamename',
          'b.admin AS admin',
          'b.botid AS botid',
          'b.reason AS reason',
          's.name AS servername',
          's.id AS serverid',
          'bo.name AS boname',
          'bo.id AS boid',
      ),
      'condition'=>'s.id = bo.serversid',
      'join'=>'INNER JOIN servers AS s ON b.server = s.server INNER JOIN bots AS bo ON b.botid = bo.botid',
      'order'=>'b.botid,b.server DESC',
      'alias'=>'b',
	  );
	
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
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('', 'safe', 'on'=>'search'),
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
		);
	}

  public function byServer($server)
  {
    if($server)
      $this->getDbCriteria()->mergeWith(array(
        'condition'=>'s.id = :server',
        'params'=>array(':server'=>$server)
      ));
    $serverCriteria['condition'] = 's.id = :server';
    $serverCriteria['params'][':server'] = $server;
    return $this;
  }

  public function byBot($bot)
  {
    if($bot)
      $this->getDbCriteria()->mergeWith(array(
        'condition'=>'bo.id = :bot',
        'params'=>array(':bot'=>$bot)
      ));
    $botCriteria['condition'] = ' bo.id = :bot';
    $botCriteria['params'][':bot'] = $bot;
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

		return new CActiveDataProvider('Bans', array(
			'criteria'=>$criteria,
		));
	}
}