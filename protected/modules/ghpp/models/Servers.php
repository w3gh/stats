<?php

/**
 * This is the model class for table "servers".
 *
 * The followings are the available columns in table 'servers':
 * @property integer $id
 * @property string $server
 * @property string $name
 * @property integer $port
 *
 * The followings are the available model relations:
 */
class Servers extends CActiveRecord
{

  public $playername, $server, $serverid, $servername;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Servers the static model class
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
		return 'servers';
	}


  public function  defaultScope() {
    return array(
      'alias' => 's',
    );
  }

  public function scopes()
  {
    return array(
      'byplayer'=>array(
        'select'=>array(
          'gp.name AS playername',
          's.server AS server',
          's.id AS serverid',
          's.name AS servername',
        ),
        'join'=>implode(' ', array(
          'LEFT JOIN gameplayers AS gp ON gp.spoofedrealm = s.server'
        )),
        'group'=>'s.server',
      )
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
			array('server, name, port', 'required'),
			array('port', 'numerical', 'integerOnly'=>true),
			array('server', 'length', 'max'=>100),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, server, name, port', 'safe', 'on'=>'search'),
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

  public function findByPlayerName($name)
  {
    return $this->byplayer()->findAll(array('condition'=>'gp.name = :name', 'params'=>array(':name'=>$name)),array(':name'=>$name));
  }


  /**
   *
   * @staticvar array $data servers list
   * @return array list for using in dropDownList
   */
  public static function getList()
  {
    static $data=array();

    if(empty($data))
    {
      $servers=self::model()->findAll();
      foreach($servers as $id => $server)
        $data[$server->server]=$server->name;
    }

    return $data;
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
		$criteria->compare('server',$this->server,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('port',$this->port);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}