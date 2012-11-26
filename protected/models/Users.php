<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string $password
 * @property string $birthday
 * @property string $gender
 * @property string $physical_address
 * @property integer $created_by
 * @property string $created_date
 * @property integer $modified_by
 * @property string $modified_date
 * @property string $ipaddress
 * @property string $status
 */
class Users extends CActiveRecord
{
        public $confirm_password;
        
        public $year;
        public $month;
        public $date;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, email_address, password, physical_address', 'length', 'max'=>255),
                        array('email_address','unique'),
                        array('email_address','email','message'=>'Not valid email address'),
                        array('first_name, last_name, email_address','required','on'=>array('updateuser')),
			array('first_name, last_name, email_address, password, confirm_password','required','on'=>array('usercreate')),
                        array('password', 'compare','compareAttribute'=>'confirm_password','on'=>array('usercreate')),
			array('gender, status', 'length', 'max'=>1),
			array('birthday,confirm_password', 'safe'),
                        
			// The following rule is used by search().
			// Please remove those attributes  that should not be searched.
			array('id, first_name, last_name, confirm_password, email_address, password, birthday, gender, physical_address, created_by, created_date, modified_by, modified_date, ipaddress, status', 'safe', 'on'=>'search'),
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
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email_address' => 'Email Address',
			'password' => 'Password',
                        'confirm_password' => 'Confirm Password',
			'birthday' => 'Birthday',
			'gender' => 'Gender',
			'physical_address' => 'Physical Address',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
			'modified_by' => 'Modified By',
			'modified_date' => 'Modified Date',
			'ipaddress' => 'Ipaddress',
			'status' => 'Status',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('physical_address',$this->physical_address,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('ipaddress',$this->ipaddress,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}