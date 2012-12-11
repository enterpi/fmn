<?php

/**
 * This is the model class for table "questions".
 *
 * The followings are the available columns in table 'questions':
 * @property integer $id
 * @property string $question
 * @property string $status
 *
 * The followings are the available model relations:
 * @property QuestionOptions[] $questionOptions
 * @property UsersAnswers[] $usersAnswers
 */
class Questions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Questions the static model class
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
		return 'questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question', 'required'),
			array('status', 'length', 'max'=>1),
			array('question,
					status',
					'required',
					'on'=>array('updateques')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, question, status', 'safe', 'on'=>'search'),
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
			'questionOptions' => array(self::HAS_MANY, 'QuestionOptions', 'questions_id'),
			'usersAnswers' => array(self::HAS_MANY, 'UsersAnswers', 'questions_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question' => 'Question',
			'status' => 'Status',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
			'modified_by' => 'Modified By',
			'modified_date' => 'Modified Date',
			'ipaddress' => 'Ipaddress',
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
		$criteria->compare('question',$this->question,true);
		//$criteria->compare('status',$this->status);
		if(!isset($_GET['Questions_sort']))
		{
			$criteria->order = 'question ASC';
		}
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}