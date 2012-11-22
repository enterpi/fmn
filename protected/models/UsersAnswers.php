<?php

/**
 * This is the model class for table "users_answers".
 *
 * The followings are the available columns in table 'users_answers':
 * @property integer $id
 * @property integer $users_id
 * @property integer $questions_id
 * @property integer $question_options_id
 *
 * The followings are the available model relations:
 * @property Questions $questions
 * @property QuestionOptions $questionOptions
 * @property Users $users
 */
class UsersAnswers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsersAnswers the static model class
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
		return 'users_answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, questions_id, question_options_id', 'required'),
			array('users_id, questions_id, question_options_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, users_id, questions_id, question_options_id', 'safe', 'on'=>'search'),
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
			'questions' => array(self::BELONGS_TO, 'Questions', 'questions_id'),
			'questionOptions' => array(self::BELONGS_TO, 'QuestionOptions', 'question_options_id'),
			'users' => array(self::BELONGS_TO, 'Users', 'users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'users_id' => 'Users',
			'questions_id' => 'Questions',
			'question_options_id' => 'Question Options',
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
		$criteria->compare('users_id',$this->users_id);
		$criteria->compare('questions_id',$this->questions_id);
		$criteria->compare('question_options_id',$this->question_options_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}