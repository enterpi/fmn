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
class ChangePassword extends CFormModel
{
	public $password;
        public $confirm_password;
        public $current_password;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password,confirm_password', 'length', 'max'=>255),
			array('password,confirm_password', 'required'),
                        array('current_password','required','on'=>'pwdchange'),
			array('password', 'compare','compareAttribute'=>'confirm_password')
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
			'password' => 'Password',
                        'confirm_password'=>'Confirm Password',
                        'current_password' => 'Current Password'
		);
	}

	
}