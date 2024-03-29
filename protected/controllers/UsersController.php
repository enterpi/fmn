<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','create','fpmail','GetReminders',
                                    'changepassword','GetOccasions','getNotifications','confirmregistration'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','updateuser','view',
                                            'saveanswer','changepwd','sendinvite','saveReminder','hideOccasions','profile'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','addUser'),
				'users'=>array(Yii::app()->params['adminlogin']),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

	}
	

	public function actionGetOccasions()
	{
		//print_r($_POST); die;
		$userFriend_occasions = new User_friends_Occasions;
		$ip_array = array('user_id'=>$_POST['user_id'],'p_month'=>$_POST['p_month']);
		$freinds_occasions = $userFriend_occasions->getUser_friends_Occasions($ip_array);
		//echo json_encode($freinds_occasions);
		echo $this->renderPartial('occasions',array(
			'freinds_occasions'=>$freinds_occasions
		));
	}

        public function actionSaveReminder()
        {
            $userFriend_occasions = new User_friends_Occasions;
            $ip_array = array('occ_id'=>Yii::app()->input->stripClean(Yii::app()->input->post('occ_id')),
                            'remind_date'=>date('Y-m-d',strtotime(Yii::app()->input->stripClean(Yii::app()->input->post('remind_date')))));
            if($userFriend_occasions->setReminderDate($ip_array))
            {
                echo 'success';
            }
            else
            {
                echo 'error';
            }
            //echo json_encode($freinds_occasions);
            /*echo $this->renderPartial('occasions',array(
                    'freinds_occasions'=>$freinds_occasions
            ));*/
        }
		
		public function actionGetReminders()
		{		
			$userFriend_occasions = new User_friends_Occasions;
			$ip_array = array('to_date'=>gmdate('Y-m-d'));
			$reminder_occasions = $userFriend_occasions->getReminder_Occasions($ip_array);
			
			$user_friends_occ = array(); 
			//echo '<pre>'; print_r($reminder_occasions);die;
			foreach($reminder_occasions as $val)
			{
				//echo '<pre>';
				//print_r($val); die;
				$user_friends_occ[$val['id']][] = array(
												 'friend_name'=>ucfirst($val['friend_name']),
												 'occasion_date'=>date('F d', strtotime($val['occasion_date'])),
												 'user_email_id'=>ltrim($val['email_address'], " fb_"),
												 'occasion_name'=>$val['occasion_name'],
												 'profile_img_path' => ($val['profile_img_path']!=''?$val['profile_img_path']:Yii::app()->request->baseUrl.'/css/images/gift.png')
												 );
			}
			$message = '';
			if(!empty($user_friends_occ))
			{
				foreach($user_friends_occ as $user_id=>$occasions)
				{
					$message .= '<div style="border:1px solid #CCC; overflow:hidden;">
						<div style="font-size:20px; border-bottom:1px solid #CCC; font-family:Palatino Linotype; margin-top:-32px; line-height:45px; margin-bottom:15px; padding-left:15px; background-color:#E9E9E9;">Birthday Reminder</div>';
					foreach($occasions as $labels=>$details)
					{
						$message .= '<table style="margin:0px 0px 10px 10px; font-family:Arial; font-size:12px;">
							<tr style="margin:0px;">
								<td><img style="margin:0px 5px 0px 0px;" src="'.$details['profile_img_path'].'" /></td>
								<td style="line-height:20px">'.$details['friend_name'].'<br>'.$details["occasion_date"].'</td>
							</tr>
						</table>';
						$user_email = $details["user_email_id"];
					}
					$message .= '</div>';
					
					$subject = 'FORGETMNOT Birthday Reminder';
                    $email = array();
                    $email['from'] = 'admin@fmn.com';
                    $email['from_name'] = 'Admin';
                    $email['to'] = $user_email;
                    $email['message'] = $message;
                    $email['subject'] = $subject;
                    $mail = new SendEmail;
                    $mail->send($email);
                    echo "success";
				}
			}
			//echo '<pre>'; print_r($user_friends_occ); die;
		}
	
	public function actionhideOccasions()
	{
            $occ_id = Yii::app()->input->stripClean(Yii::app()->input->post('occ_id'));
            $sts_value = Yii::app()->input->stripClean(Yii::app()->input->post('sts_value'));
            $model=UserFriends::model()->findByPk($occ_id);
            $UsersOccasions = UserFriends::model()->findByPk($occ_id);
            $UsersOccasions->hide_occ = $sts_value; 
            if($UsersOccasions->save())
                            echo true;
                    else
                            echo false;
	}

        public function actionSaveanswer()
        {
            $question_id = $_POST['question'];
            $option_id = $_POST['answer'];
            $user_id = Yii::app()->user->getid();
            $usersanswers_model = new UsersAnswers();
            $usersanswers_model->question_options_id = $option_id;
            $usersanswers_model->questions_id = $question_id;
            $usersanswers_model->users_id = $user_id;
            if($usersanswers_model->save())
            {
                echo "success";
            }
            else
            {
                echo "fail";
            }

        }
	public function actiongetNotifications()
	{
		$userFriend_occasions = new User_friends_Occasions;
		$notification_date_repitive = date('m-d', strtotime(date('Y-m-d'). ' + 14 days'));
		$notification_date = date('Y-m-d', strtotime(date('Y-m-d'). ' + 14 days'));
		$to_day_repitive = date('m-d');
		$to_day = date('Y-m-d');
		$ip_array = array(
						  'user_id'=>$_POST['user_id'],
						  'notification_date_repitive'=>$notification_date_repitive,
						  'to_day_repitive'=>$to_day_repitive,
						  'notification_date'=>$notification_date,
						  'to_day'=>$to_day);
		$freinds_notifications = $userFriend_occasions->getUser_friends_Notifications($ip_array);
		echo $this->renderPartial('notifications',array(
			'freinds_notifications'=>$freinds_notifications,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//echo CHttpRequest::getUserHostAddress(); die;
		$model=new Users();
                $model->setScenario('usercreate');


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
                        $pwd = $_POST['Users']['password'];
                        $c_pwd = $_POST['Users']['confirm_password'];

                        $md5_pwd = $pwd!=""?md5($pwd):$pwd;
                        $md5_confirmpwd = $c_pwd!=""?md5($c_pwd):$c_pwd;

                        $user = Yii::app()->input->stripClean($_POST['Users']);

                        if($user['month'] != '' && $user['year']!='' && $user['year']!='')
                        $user['birthday'] = date('Y-m-d',strtotime($user['month'].'/'.$user['date'].'/'.$user['year']));
                        else
                        $user['birthday'] = null;

                        $user['password'] = $md5_pwd;
                        $user['confirm_password'] = $md5_confirmpwd;
						$user['ipaddress'] =  Yii::app()->request->userHostAddress;
						$user['created_date'] =  date('Y-m-d');
						$user['modified_date'] =  date('Y-m-d');
						$model->attributes=$user;
                        if($model->validate())
                        {
                            if($model->save())
                            {
                                    $this->actionFpmail($user['email_address'],'confirmRegistration');
                                    Yii::app()->clientScript->registerCoreScript('jquery');
                                    $this->render('confirm',array('email'=>$user['email_address']));
                                    unset($_POST['Users']);
                            }
                            else
                            {
                                    $user['password'] = $pwd;
                                    $user['confirm_password'] = $c_pwd;
                                    $model->attributes = $user;
                                    $this->render('create',array(
                                            'model'=>$model,
                                    ));
                            }
                        }
                        else
                        {       
                                $user['password'] = $pwd;
                                $user['confirm_password'] = $c_pwd;
                                $model->attributes = $user;
                                $this->render('create',array(
                                        'model'=>$model,
                                ));
                        }
                }
                else
                {
                        $this->render('create',array(
                                'model'=>$model,
                        ));
                }
	}
        
        
        /* Function to check whether a token from a given url exists for confirming registration. 
         * If exists change the user status to 1 
         * param from GET token
         */
        public function actionConfirmregistration()
        {
            $token = Yii::app()->input->get('token');
            $condition=array(
                        'select'=>'email,token,token_for',
                        'condition'=>'token=:token',
                        'params'=>array(':token'=>$token)
                    );
            $savedtoken = ResetPassword::model()->find($condition);
            if($savedtoken && $savedtoken->token_for=='2')
            {
                // form inputs are valid, do something here
                $user = Users::model()->findByAttributes(array('email_address'=>$savedtoken->email));
                $user->status = '1';
                $user->save();
                $savedtoken->delete();
                $login_model = new LoginForm;
                $login_model->password = $user->password;
                $login_model->username = $user->email_address;
                if($login_model->login())
                {
                    $this->redirect(array('/users'));
                }
            }
            else
            {
                    $this->redirect(array('/site/login'));
            }
            
        }

        /*
         * @param integer $id
         */

        public function actionUpdateuser()
        {
            $id = Yii::app()->user->getId();
			$model=Users::model()->findByPk($id);
			$page_from_admin = false;
			$user_details = UserIdentity::getUserDetails($id);
			if($user_details->is_admin == 'Y') $page_from_admin = true;
            if($model->status != '4')
            {
                $model->setScenario('updateuser');
                // uncomment the following code to enable ajax-based validation
                /*
                if(isset($_POST['ajax']) && $_POST['ajax']==='users-updateuser-form')
                {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }
                */

                if(isset($_POST['Users']))
                {
                    $model->attributes=$_POST['Users'];
                    if($model->validate())
                    {
                            $user = Yii::app()->input->stripClean($_POST['Users']);
                            $user['birthday'] = date('Y-m-d',strtotime($user['month'].'/'.$user['date'].'/'.$user['year']));
							$model->ipaddress =  Yii::app()->request->userHostAddress;
							$model->modified_by =  $id; 
							$model->modified_date =gmdate('Y-m-d H:i:s');
                            $model->attributes=$user;
                            if($model->save())
                                    if($user_details->is_admin == 'Y')
										$this->redirect(array('/users/admin'));
									else
										$this->redirect(array('/users'));
                    }
                }
				
                $this->render('updateuser',array('model'=>$model,'page_from_admin'=>$page_from_admin));
            }
            
        }
		
		public function actionaddUser()
        {
			
			$model=new Users();
			$model->setScenario('adduser');
			$user_id = Yii::app()->user->getId();
			if(isset($_POST['Users']))
			{
				$pwd = $_POST['Users']['password'];
				$c_pwd = $_POST['Users']['confirm_password'];

				$md5_pwd = $pwd!=""?md5($pwd):$pwd;
				$md5_confirmpwd = $c_pwd!=""?md5($c_pwd):$c_pwd;

				$user = Yii::app()->input->stripClean($_POST['Users']);

				if($user['month'] != '' && $user['year']!='' && $user['year']!='')
				$user['birthday'] = date('Y-m-d',strtotime($user['month'].'/'.$user['date'].'/'.$user['year']));
				else
				$user['birthday'] = null;

				$user['password'] = $md5_pwd;
				$user['confirm_password'] = $md5_confirmpwd;
				$user['status']=1;
				$model->ipaddress =  Yii::app()->request->userHostAddress;
				$model->created_by =  $user_id;
				$model->modified_by =  $user_id; 
				$model->created_date = gmdate('Y-m-d H:i:s');
				$model->modified_date =gmdate('Y-m-d H:i:s');

				$model->attributes=$user;
				
					if($model->validate())
					{
						//print_r($user); die;
						if($model->save())
						{
								 $this->redirect(array('users/admin'));
								/*$this->actionFpmail($user['email_address'],'confirmRegistration');
								Yii::app()->clientScript->registerCoreScript('jquery');
								$this->render('confirm',array('email'=>$user['email_address']));
								unset($_POST['Users']);*/
						}
						else
						{
								$user['password'] = $pwd;
								$user['confirm_password'] = $c_pwd;
								$model->attributes = $user;
								$this->render('addUser',array(
										'model'=>$model,
								));
						}
					}
					else
					{       
							$user['password'] = $pwd;
							$user['confirm_password'] = $c_pwd;
							$model->attributes = $user;
							$this->render('addUser',array(
									'model'=>$model,
							));
					}
                }
                else
                {
                        $this->render('addUser',array(
                                'model'=>$model,
                        ));
                }
            
        }
        
        
        public function actionUpdate($id)
        {
            $model=Users::model()->findByPk($id);
            $model->setScenario('updateuser');
			$user_id = Yii::app()->user->getid();
            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='users-updateuser-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */

            if(isset($_POST['Users']))
            {
                $model->attributes=$_POST['Users'];
                if($model->validate())
                {
                        $user = Yii::app()->input->stripClean($_POST['Users']);
                        $user['birthday'] = date('Y-m-d',strtotime($user['month'].'/'.$user['date'].'/'.$user['year']));
						$model->ipaddress =  Yii::app()->request->userHostAddress;
						$model->modified_by =  $user_id; 
						$model->modified_date =gmdate('Y-m-d H:i:s');

						$model->attributes=$user;
                        if($model->save())
                                $this->redirect(array('admin'));
                }
            }
            $this->render('updateprofile',array('model'=>$model));
        }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
                
                $model = UsersAnswers::model()->findByAttributes(array('user_id'=>$id));
                $model->delete();
                $model = UsersFriends::model()->findByAttributes(array('user_id'=>$id));
                $model->delete();
                

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/

		$name = Yii::app()->user->getName();
                $id = Yii::app()->user->getId();
                $answered_questions = UsersAnswers::model()->findAll(array(
                                                                       'select'=>'questions_id',
                                                                        'condition'=>'users_id=:usersID',
                                                                        'params'=>array(':usersID'=>$id),         
                                                                        ));
                $ids = array();
                foreach($answered_questions as $ans_q)
                {
                    $ids[] = $ans_q->questions_id;
                }
                if(sizeof($ids)>0)
                {
                    $cond = array('condition'=>'t.id NOT IN ('.implode(',',$ids).') AND t.status="1"');
                }
                else
                {
                    $cond = array('condition'=>'t.status="1"');
                }
                $questions = Questions::model()->with(array('questionOptions'=>array(
                                                                'joinType'=>'INNER JOIN',
                                                                )
                                                        ))->findAll($cond);
                $view_questions = array();
                foreach($questions as $question)
                {
                    $view_questions[$question->id]['question'] = str_replace('{user name}', $name, $question->question);
                    $view_questions[$question->id]['question_id'] = $question->id;
                    $options = array();
                    foreach($question->questionOptions as $option)
                    {
                    $options[$option->id]['option'] = $option->option;
                    $options[$option->id]['id'] = $option->id;
                    }
                    $view_questions[$question->id]['options'] = array_values($options);
                }
		$p_month = date('n');
                Yii::app()->clientScript->registerCoreScript('jquery');
		//echo '<pre>';print_r($freinds_occasions); die;
		$this->render('friends_occasions',array(
			'p_month'=>$p_month,
			'user_id'=>$id,
                        'questions'=> json_encode(array_values($view_questions))
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
                
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

                $this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

        /*function called for forgot password functionality
         * User clicks the link in the mail sent to him
         * params GET token
         */
        public function actionChangepassword()
        {
            $model= new ChangePassword();
            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='users-changepassword-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */
            $token = Yii::app()->input->get('token');
            $condition=array(
                        'select'=>'email,token,token_for',
                        'condition'=>'token=:token',
                        'params'=>array(':token'=>$token)
                    );
            $savedtoken = ResetPassword::model()->find($condition);
            if($savedtoken && $savedtoken->token_for=='1')
            {
                    if(isset($_POST['ChangePassword']))
                    {
                            $model->attributes=$_POST['ChangePassword'];

                            if($model->validate())
                            {
                                    // form inputs are valid, do something here
                                    $user = Users::model()->findByAttributes(array('email_address'=>$savedtoken->email));
                                    $user->password = md5($model->confirm_password);
                                    $user->save();
                                    $savedtoken->delete();
                                    $this->redirect(array('/users'));
                            }
                                    //$this->render('changepassword',array('model'=>$model));
                    }
                    $this->render('changepassword',array('model'=>$model));
            }
            else
            {
                    $this->redirect(array('/site/login'));
            }

        }

        /*function called for change of password for an authenticated user
         * params POST ChangepPassword array containing current_password,password,confirm_password,
         */
        public function actionChangepwd()
        {
            $model=new ChangePassword;
            $model->setScenario('pwdchange');
            
            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='change-password-changepwd-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */
            Yii::app()->clientScript->registerCoreScript('jquery');
            if(isset($_POST['ChangePassword']))
            {
				$user_id = Yii::app()->user->getid();
				$user = Users::model()->findByAttributes(array('id'=>$user_id));
                if($user->status != '4')
                {
                    $model->attributes=$_POST['ChangePassword'];
                    if($model->validate())
                    {
                        if($user)
                        {
                            $user->password = md5($model->confirm_password);
                            $user->save();
                            $this->redirect(array('/users'));
                        }
                        else
                        {
                            $model->addError('current_password', 'Incorrect Current Password!');
                        }

                    }
                }
            }
            
            $this->render('changepwd',array('model'=>$model));
        }

        public function actionSendinvite()
        {
            $email_address = isset($_POST['emailid'])?$_POST['emailid']:null;
            if(filter_var($email_address, FILTER_VALIDATE_EMAIL))
            {
                    $link = CHtml::link('FORGETMNOT','http://'.Yii::app()->request->getServerName().Yii::app()->baseUrl);    
                    $msg = 'Your friend invited you to join FORGETMNOT. Please click on the link below to join <br/>'.$link;
                    $subject = 'FORGETMNOT Invitation';
               
                    $email = array();
                    $email['from'] = 'admin@fmn.com';
                    $email['from_name'] = 'Admin';
                    $email['to'] = $email_address;
                    $email['message'] = $msg;
                    $email['subject'] = $subject;
                    $mail = new SendEmail;
                    $mail->send($email);
                    echo "success";
            }
            else {
                    echo "fail";
            }
        }

        public function actionFpmail($email_address = null,$for=null)
        {
            $email_address = isset($_POST['emailid'])?$_POST['emailid']:$email_address;
            if(filter_var($email_address, FILTER_VALIDATE_EMAIL))
            {
                $for = isset($_POST['for'])?$_POST['for']:$for;
                $record=Users::model()->findByAttributes(array('email_address'=>$email_address));
                if($record===null)
                {
                    echo '1';
                }
                elseif($email_address!=null)
                {
                    $token = md5($email_address.time());
                    if($for == 'changepwd')
                    {
                        $link = CHtml::link('Click here',
                                'http://'.Yii::app()->request->getServerName().Yii::app()->baseUrl.'/users/Changepassword?token='.$token);
                        $for = '1';
                        $msg = 'Please click the below link and change your password <br/>'.$link;
                        $subject = 'FMN Forgot Password';
                    }
                    elseif($for=='confirmRegistration')
                    {
                        $link = CHtml::link('Click here',
                                'http://'.Yii::app()->request->getServerName().Yii::app()->baseUrl.'/users/confirmregistration?token='.$token);    
                        $for = '2';
                        $msg = 'Please click the below link to Confirm your FORGETMNOT Registration <br/>'.$link;
                        $subject = 'FMN Registration';
                    }
                    
                    $email = array();
                    $email['from'] = 'admin@fmn.com';
                    $email['from_name'] = 'Admin';
                    $email['to'] = $email_address;
                    $email['message'] = $msg;
                    $email['subject'] = $subject;
                    $mail = new SendEmail;
                    $mail->send($email);
                    $model = new ResetPassword;
                    $model->email = $email_address;
                    $model->token = $token;
                    $model->token_for = $for;
                    $model->save();
                    if($for == '1')
                    echo "2";
                }
            }
            else 
            {
                echo '1';
            }
        }
		public function actionProfile($email_address = null,$for=null)
        {
			$name = Yii::app()->user->getName();
                $id = Yii::app()->user->getId();
                $answered_questions = UsersAnswers::model()->findAll(array(
                                                                       'select'=>'questions_id',
                                                                        'condition'=>'users_id=:usersID',
                                                                        'params'=>array(':usersID'=>$id),         
                                                                        ));
                $ids = array();
                foreach($answered_questions as $ans_q)
                {
                    $ids[] = $ans_q->questions_id;
                }
                if(sizeof($ids)>0)
                {
                    $cond = array('condition'=>'t.id NOT IN ('.implode(',',$ids).') AND t.status="1"');
                }
                else
                {
                    $cond = array('condition'=>'t.status="1"');
                }
                $questions = Questions::model()->with(array('questionOptions'=>array(
                                                                'joinType'=>'INNER JOIN',
                                                                )
                                                        ))->findAll($cond);
                $view_questions = array();
                foreach($questions as $question)
                {
                    $view_questions[$question->id]['question'] = str_replace('{user name}', $name, $question->question);
                    $view_questions[$question->id]['question_id'] = $question->id;
                    $options = array();
                    foreach($question->questionOptions as $option)
                    {
                    $options[$option->id]['option'] = $option->option;
                    $options[$option->id]['id'] = $option->id;
                    }
                    $view_questions[$question->id]['options'] = array_values($options);
                }
                Yii::app()->clientScript->registerCoreScript('jquery');
				//echo '<pre>';print_r($freinds_occasions); die;
				$this->render('profile',array(
					'user_id'=>$id,
					'questions'=> json_encode(array_values($view_questions))
				));
		}
}
