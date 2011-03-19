<?php

/**
 * This is the model class for table "bans".
 *
 * The followings are the available columns in table 'bans':
 * @property integer $id
 * @property integer $botid
 * @property string $server
 * @property string $name
 * @property string $ip
 * @property string $date
 * @property string $gamename
 * @property string $admin
 * @property string $reason
 *
 * The followings are the available model relations:
 */
class Bans extends CActiveRecord
{
  /**
   * @var string
   */
  public $datetime,
         $servername, $serverid,
         $boname;

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
			array('botid', 'numerical', 'integerOnly'=>true),
			array('server', 'length', 'max'=>100),
			array('name, ip, admin', 'length', 'max'=>15),
			array('gamename', 'length', 'max'=>31),
			array('reason', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, botid, server, name, ip, date, gamename, admin, reason', 'safe', 'on'=>'search'),
		);
	}

  public function defaultScope() 
	{
	  return array(
	     'select'=>array(
          'b.id AS id',
          'b.name AS name', 
          'b.server AS server',
          'b.ip AS ip',
          'b.date AS datetime',
          'DATE_FORMAT(b.date,"%d %m %Y") AS date',
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
      'join'=>implode(' ',array(
        'LEFT JOIN servers AS s ON b.server = s.server',
        'LEFT JOIN bots AS bo ON b.botid = bo.botid',
      )),
      'order'=>'b.botid,b.server DESC',
      'alias'=>'b',
	  );
	
	}

  public function  scopes() {
    return array(
        'servers'=>array(
          'select'=>'b.server',
          'group'=>'b.server',
          'order'=>'b.server',
          'condition'=>"b.server <> ''"
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

		$criteria->compare('id',$this->id);
		$criteria->compare('botid',$this->botid);
		$criteria->compare('server',$this->server,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('gamename',$this->gamename,true);
		$criteria->compare('admin',$this->admin,true);
		$criteria->compare('reason',$this->reason,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}