<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
        private $_name;
        public function authenticate()
        {
            $criteria=new CDbCriteria;
            $criteria->condition='email_address=:emailAddress AND (status=:Status OR status=:Stat)';
            $criteria->params=array(':emailAddress'=>$this->username,':Status'=>'1',':Stat'=>'4');
            $record=Users::model()->find($criteria);
            if($record===null)
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            else if($record->password!==$this->password)
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else
            {
                $this->_id=$record->id;
                $this->_name = $record->first_name.' '.$record->last_name;
                //$this->setState('title', $record->title);
                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
        public function getId()
        {
            return $this->_id;
        }
        public function getFullName()
        {
            //echo 3123;die;
			return $this->_name;
        }
		
        public function getUserDetails($id)
        {
                $record_details=Users::model()->findByAttributes(array('id'=>$id));
                return $record_details;
                //echo '<pre>';print_r($record_details);die;
        }
}