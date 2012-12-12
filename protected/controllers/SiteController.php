<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		$id = Yii::app()->user->getId();
		if(isset($id))
		{
			$user_details = UserIdentity::getUserDetails(Yii::app()->user->getId());
			if($user_details->is_admin == 'N') $this->redirect(array('users/'));
			else if($user_details->is_admin == 'Y') $this->redirect(array('users/admin'));
		}
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
                        $pwd = $_POST['LoginForm']['password'];
                        $login = Yii::app()->input->stripClean($_POST['LoginForm']);
                        $login['password'] = md5($pwd);
			$model->attributes=$login;
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                            $id = Yii::app()->user->getid();
				//$this->redirect(Yii::app()->user->returnUrl);
                                if($_POST['LoginForm']['username'] == Yii::app()->params['adminlogin'])
								{
									$this->redirect(array('users/admin'));
								}
								else
								{
								$this->redirect(array('users/'));
								}
                        }
                        else{
                            $login['password'] = $pwd;
                            $model->attributes=$login;
                        }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        /*
         * facebook login
         */
        public function actionFblogin()
        {
            if(isset($_POST['accessToken']) && isset($_POST['userID']) && isset($_POST['email']))
            {
				$id = Yii::app()->input->stripClean($_POST['userID']);
                $access_token = Yii::app()->input->stripClean($_POST['accessToken']);
                $email_id = Yii::app()->input->stripClean($_POST['email']);
                $first_name = Yii::app()->input->stripClean($_POST['first_name']);
                $last_name = Yii::app()->input->stripClean($_POST['last_name']);
                $gender = Yii::app()->input->stripClean($_POST['gender']);
                $birthday = Yii::app()->input->stripClean($_POST['birthday']);
                $birthday = date('Y-m-d',  strtotime($birthday));
				$profile_img_path = (isset($_POST['picture']['data']['url'])?$_POST['picture']['data']['url']:'');
                if(filter_var($email_id, FILTER_VALIDATE_EMAIL))
                {
                    $user = Users::model()->find(array(
                                            'select'=>'fb_id,password',
                                            'condition'=>'fb_id=:fbID AND email_address=:emailID AND status=:Status',
                                            'params'=>array(':fbID'=>$id,':emailID'=>'fb_'.$email_id,':Status'=>4), 
                                   ));
                    if($user == null)
                    {
                        $model = new Users();
                        $model->fb_id = $id;
                        $model->access_token = $access_token;
                        $model->email_address = 'fb_'.$email_id;
                        $model->status = '4';
                        $pwd = md5($email_id.time());
                        $model->password = $pwd;
                        $model->first_name = $first_name;
                        $model->last_name = $last_name;
                        $model->gender = $gender;
                        $model->birthday = $birthday;
						$model->profile_img_path = $profile_img_path;
                        $model->save();
                        $first_login = true;
                    }
                    else
                    { 
                        $pwd = $user->password;
                        $first_login = false;
                    }

                    $login_model = new LoginForm;
                    $login_model->username = 'fb_'.$email_id;
                    $login_model->password = $pwd;
                    $login_model->login();

                    if(!$first_login)
                    echo Yii::app()->createUrl('/users');
                    else
                    echo 'user_first_login';
                }
                
            }
        }
		
		public function actionAdduserfriends()
		{
			$user_id = Yii::app()->user->getId();
			$imp_friends_sql = 'INSERT INTO user_friends(users_id, first_name, last_name, fb_id, gender, occasion_id, occasion_date, profile_img_path, is_fmn_user) VALUES ';
			foreach($_POST['friends']['data'] as $friends_details)
			{
				$first_name = (isset($friends_details['first_name'])?$friends_details['first_name']:'');
				$last_name = (isset($friends_details['last_name'])?$friends_details['last_name']:'');
				$gender = (isset($friends_details['gender'])?$friends_details['gender']:'');
				$fb_id = (isset($friends_details['id'])?$friends_details['id']:'');
				$birthday = (isset($friends_details['birthday'])?$friends_details['birthday']:'');
				$profile_img_path = (isset($friends_details['picture']['data']['url'])?$friends_details['picture']['data']['url']:'');
				 
				$user = Users::model()->find(array(
                                            'select'=>'id,fb_id',
                                            'condition'=>'fb_id=:fbID AND status=:Status',
                                            'params'=>array(':fbID'=>$fb_id,':Status'=>4), 
                                   ));
				
				$is_fmn_user = 'y';
				if($user == null)
				{
					$is_fmn_user = 'n';
				}
				
				if($birthday!='')
				{
					$imp_friends_sql .= "('".$user_id."','".$first_name."','".$last_name."','".$fb_id."','".$gender."','1','".$birthday."','".$profile_img_path."','".$is_fmn_user."'),";
				}
			}
			$imp_friends_sql = rtrim($imp_friends_sql,',');
			$connection=Yii::app()->db;
			$command=$connection->createCommand($imp_friends_sql);
		    $command->execute();
		}
}