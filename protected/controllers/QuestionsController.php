<?php

class QuestionsController extends Controller
{
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('view','update'),
				'users'=>array(Yii::app()->params['adminlogin']),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionView()
	{
		$model=new Questions();
		$this->render('admin_question',array('model'=>$model));
	}
	
	public function actionUpdate($id)
	{ 
		$model=Questions::model()->findByPk($id);
		$model->setScenario('updateques');
		$user_id = Yii::app()->user->getid();
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-updateuser-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		if(isset($_POST['Questions']))
		{
					//echo '<pre>'; print_r($_POST['Questions']);die;

			$model->attributes=$_POST['Questions'];
			if($model->validate())
			{
					$questions = Yii::app()->input->stripClean($_POST['Questions']);
					$model->ipaddress =  Yii::app()->request->userHostAddress;
					$model->modified_date =  gmdate('Y-m-d H:i:s');
					$model->modified_by =  $user_id;
					$model->attributes=$questions;
					if($model->save())
							$this->redirect(array('questions/view'));
			}
		}
		$this->render('updateques',array('model'=>$model,'from_page'=>'update'));
	}
	
	public function actionAddques()
	{ 
		$model=new Questions();
		$model->setScenario('updateques');
		$user_id = Yii::app()->user->getid();
		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-updateuser-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		*/

		if(isset($_POST['Questions']))
		{
			$model->attributes=$_POST['Questions'];
			if($model->validate())
			{
					$questions = Yii::app()->input->stripClean($_POST['Questions']);
					
					$model->ipaddress =  Yii::app()->request->userHostAddress;
					$model->created_date =  gmdate('Y-m-d H:i:s');
					$model->modified_date =  gmdate('Y-m-d H:i:s');
					$model->created_by =  $user_id;
					$model->modified_by =  $user_id;
					$model->attributes=$questions;
					if($model->save())
							$this->redirect(array('questions/view'));
			}
		}
		$this->render('updateques',array('model'=>$model,'from_page'=>'add'));
	}
}