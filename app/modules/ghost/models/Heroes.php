<?php

/**
 * This is the model class for table "heroes".
 *
 * The followings are the available columns in table 'heroes':
 * @property string $heroid
 * @property string $original
 * @property string $description
 * @property string $summary
 * @property string $stats
 * @property string $skills
 */
class Heroes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Heroes the static model class
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
		return 'heroes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('heroid, original, description, summary, stats, skills', 'required'),
			array('heroid, original', 'length', 'max'=>4),
			array('description', 'length', 'max'=>32),
			array('summary', 'length', 'max'=>900),
			array('stats, skills', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('heroid, original, description, summary, stats, skills', 'safe', 'on'=>'search'),
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
			'heroid' => 'Heroid',
			'original' => 'Original',
			'description' => 'Description',
			'summary' => 'Summary',
			'stats' => 'Stats',
			'skills' => 'Skills',
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

		$criteria->compare('heroid',$this->heroid,true);
		$criteria->compare('original',$this->original,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('stats',$this->stats,true);
		$criteria->compare('skills',$this->skills,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}