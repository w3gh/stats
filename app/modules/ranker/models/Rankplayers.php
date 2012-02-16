<?php

/**
 * This is the model class for table "rankplayers".
 *
 * The followings are the available columns in table 'rankplayers':
 * @property string $name
 * @property string $category
 * @property string $server
 * @property integer $games
 * @property integer $wins
 * @property integer $kills
 * @property integer $deaths
 * @property integer $assists
 * @property integer $creeps
 * @property integer $denies
 * @property integer $neutrals
 * @property integer $secondsplayed
 * @property double $contributionpoints
 * @property double $contributionpercent
 * @property double $teamadjustment
 * @property double $soloadjustment
 * @property double $rd
 *
 * The followings are the available model relations:
 */
class Rankplayers extends CActiveRecord
{
  public $skill;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Rankplayers the static model class
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
		return 'rankplayers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, category, server, games, wins, kills, deaths, assists, creepkills, creepdenies, neutralkills, secondsplayed, contributionpoints, contributionpercent, teamadjustment, soloadjustment', 'required'),
			array('games, wins, kills, deaths, assists, creepkills, creepdenies, neutralkills, secondsplayed', 'numerical', 'integerOnly'=>true),
			array('contributionpoints, contributionpercent, teamadjustment, soloadjustment, rd', 'numerical'),
			array('name', 'length', 'max'=>15),
			array('category', 'length', 'max'=>25),
			array('server', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, category, server, games, wins, kills, deaths, assists, creepkills, creepdenies, neutralkills, secondsplayed, contributionpoints, contributionpercent, teamadjustment, soloadjustment, rd', 'safe', 'on'=>'search'),
		);
	}

  public function  defaultScope() {
    return array(
        'alias'=>'rp',
        'order'=>'rp.id DESC',
    );
  }

  public function  scopes() {
    return array(
        'scores'=>array(
            'select'=>array(
                's.score AS skill',
            ),
            'join'=>'INNER JOIN scores AS s ON s.name = rp.name AND s.server = rp.server AND s.category = rp.category',
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
      'id' => 'Id',
			'name' => 'Name',
			'category' => 'Category',
			'server' => 'Server',
			'games' => 'Games',
			'wins' => 'Wins',
			'kills' => 'Kills',
			'deaths' => 'Deaths',
			'assists' => 'Assists',
			'creepkills' => 'Creeps',
			'creepdenies' => 'Denies',
			'neutralkills' => 'Neutrals',
			'secondsplayed' => 'Secondsplayed',
			'contributionpoints' => 'Contributionpoints',
			'contributionpercent' => 'Contributionpercent',
			'teamadjustment' => 'Teamadjustment',
			'soloadjustment' => 'Soloadjustment',
			'rd' => 'Rd',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('server',$this->server,true);
		$criteria->compare('games',$this->games);
		$criteria->compare('wins',$this->wins);
		$criteria->compare('kills',$this->kills);
		$criteria->compare('deaths',$this->deaths);
		$criteria->compare('assists',$this->assists);
		$criteria->compare('creepkills',$this->creepkills);
		$criteria->compare('creepdenies',$this->creepdenies);
		$criteria->compare('neutralkills',$this->neutralkills);
		$criteria->compare('secondsplayed',$this->secondsplayed);
		$criteria->compare('contributionpoints',$this->contributionpoints);
		$criteria->compare('contributionpercent',$this->contributionpercent);
		$criteria->compare('teamadjustment',$this->teamadjustment);
		$criteria->compare('soloadjustment',$this->soloadjustment);
		$criteria->compare('rd',$this->rd);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}