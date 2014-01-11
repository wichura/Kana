<?php

/**
 * This is the model class for table "register".
 *
 * The followings are the available columns in table 'register':
 * @property string $UserId
 * @property string $ProjectId
 * @property string $ProjectDate
 * @property string $IsPresent
 */
class Register extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Register the static model class
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
		return 'register';
	}

	public function scopes() {
		return array(
			'profile' => array(
				'with' => array(
					"profile" => array(
						"joinType" => "INNER JOIN",
						"condition" => "user_id = " . Yii::app()->user->getId()
						)
					)
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
			array('UserId, ProjectId, ProjectDate', 'required'),
			array('UserId, ProjectId', 'length', 'max'=>11),
			array('IsPresent', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UserId, ProjectId, ProjectDate, IsPresent', 'safe', 'on'=>'search'),
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
			'profile' => array(self::HAS_ONE, 'Profile', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'UserId' => 'User',
			'ProjectId' => 'Project',
			'ProjectDate' => 'Project Date',
			'IsPresent' => 'Is Present',
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

		$criteria->compare('UserId',$this->UserId,true);
		$criteria->compare('ProjectId',$this->ProjectId,true);
		$criteria->compare('ProjectDate',$this->ProjectDate,true);
		$criteria->compare('IsPresent',$this->IsPresent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}