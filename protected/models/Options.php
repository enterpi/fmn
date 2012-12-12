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
class Options extends CFormModel
{
	public $option1;
        public $option2;
        public $option3;
        public $question_id;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('option1,option2,option3','required','on'=>'updateoptions'),
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
			'option1' => 'Option 1',
                        'option2'=>'Option 2',
                        'option3' => 'Option 3'
		);
	}

	
}