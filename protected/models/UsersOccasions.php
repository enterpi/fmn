<?php

/**
 * This is the model class for table "users_occassions".
 *
 * The followings are the available columns in table 'users_occassions':
 * @property integer $id
 * @property integer $users_id
 * @property integer $occassions_id
 * @property string $occassion_date
 * @property string $status
 * @property string $hide_occ
 */
class UsersOccasions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsersOccassions the static model class
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
		return 'users_occasions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, occasions_id, occasion_date', 'required'),
			array('users_id, occasions_id', 'numerical', 'integerOnly'=>true),
			array('status, hide_occ', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, users_id, occasions_id, occasion_date, status, hide_occ', 'safe', 'on'=>'search'),
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
			'users_id' => 'Users',
			'occasions_id' => 'Occasions',
			'occasion_date' => 'Occasion Date',
			'status' => 'Status',
			'hide_occ' => 'Hide Occ',
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
		$criteria->compare('occasions_id',$this->occasions_id);
		$criteria->compare('occasion_date',$this->occasion_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('hide_occ',$this->hide_occ,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}