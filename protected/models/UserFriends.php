<?php

/**
 * This is the model class for table "user_friends".
 *
 * The followings are the available columns in table 'user_friends':
 * @property integer $id
 * @property integer $users_id
 * @property string $first_name
 * @property string $last_name
 * @property string $fb_id
 * @property string $gender
 * @property integer $occasion_id
 * @property string $occasion_date
 * @property string $is_fmn_user
 * @property string $status
 * @property string $hide_occ
 * @property string $remind_date
 */
class UserFriends extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFriends the static model class
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
		return 'user_friends';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, first_name, last_name, fb_id, gender, occasion_id, occasion_date, remind_date', 'required'),
			array('users_id, occasion_id', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, fb_id', 'length', 'max'=>255),
			array('gender', 'length', 'max'=>50),
			array('occasion_date', 'length', 'max'=>100),
			array('is_fmn_user, status, hide_occ', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, users_id, first_name, last_name, fb_id, gender, occasion_id, occasion_date, is_fmn_user, status, hide_occ, remind_date', 'safe', 'on'=>'search'),
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
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'fb_id' => 'Fb',
			'gender' => 'Gender',
			'occasion_id' => 'Occasion',
			'occasion_date' => 'Occasion Date',
			'is_fmn_user' => 'Is Fmn User',
			'status' => 'Status',
			'hide_occ' => 'Hide Occ',
			'remind_date' => 'Remind Date',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('fb_id',$this->fb_id,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('occasion_id',$this->occasion_id);
		$criteria->compare('occasion_date',$this->occasion_date,true);
		$criteria->compare('is_fmn_user',$this->is_fmn_user,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('hide_occ',$this->hide_occ,true);
		$criteria->compare('remind_date',$this->remind_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}