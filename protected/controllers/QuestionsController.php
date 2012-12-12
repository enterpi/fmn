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
                $options = array();
                if(!isset($_POST['Questions'])){
                   $question_options = QuestionOptions::model()->findAll(array(
                                                                   'select'=>'id,`option`,questions_id,status',
                                                                    'condition'=>'questions_id=:ID',
                                                                    'params'=>array(':ID'=>$id),         
                                                                    ));
                   $options_model = new Options;
                   foreach($question_options as $option)
                    {
                        $ids[] = $option->id;
                        $op['id'] = $option->id;
                        $op['option'] = $option->option;
                        $op['status'] = $option->status;
                        $op['questions_id'] = $option->questions_id;
                        array_push($options,$op);
                    }
                } 
                
		if(isset($_POST['Questions']))
		{
					//echo '<pre>'; print_r($_POST['Questions']);die;

			$model->attributes=$_POST['Questions'];
                        $question_options = QuestionOptions::model()->findAll(array('select'=>'id',
                                                                'condition'=>'questions_id=:ID',
                                                                'params'=>array(':ID'=>$id),         
                                                                ));
                        foreach($question_options as $option)
                        {   
                            $ids[] = $option->id;
                        }
                        $i = 1;
                        foreach($ids as $id)
                        {
                            $model->{'option'.$i} = Yii::app()->input->stripClean($_POST[$id]);
                            $options[] = array('id'=>$id,'option'=>$_POST[$id]);
                            $i++;
                        }
                        
			if($model->validate())
			{
                            
					$questions = Yii::app()->input->stripClean($_POST['Questions']);
					$model->ipaddress =  Yii::app()->request->userHostAddress;
					$model->modified_date =  gmdate('Y-m-d H:i:s');
					$model->modified_by =  $user_id;
					$model->attributes=$questions;
					if($model->save())
                                        {
                                                        foreach($ids as $id)
                                                        {
                                                            $qop = QuestionOptions::model()->findByPk($id); 
                                                            $qop->option = Yii::app()->input->stripClean($_POST[$id]);
                                                            $qop->save();
                                                        }
							$this->redirect(array('questions/view'));
                                        }
			}
		}
		$this->render('updateques',array('model'=>$model,'options'=>$options,',from_page'=>'update'));
	}
	
	public function actionAddques()
	{ 
		$model=new Questions();
		$model->setScenario('addques');
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
			$model->attributes=Yii::app()->input->stripClean($_POST['Questions']);
                        $model->option1 = Yii::app()->input->stripClean($_POST['option1']);
                        $options[]['option'] = $_POST['option1'];
                        $model->option2 = Yii::app()->input->stripClean($_POST['option2']);
                        $options[]['option'] = $_POST['option2'];
                        $model->option3 = Yii::app()->input->stripClean($_POST['option3']);
                        $options[]['option'] = $_POST['option3'];
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
                                        {
                                              for($i=1;$i<=3;$i++)
                                              {
                                                    $qop = new QuestionOptions;
                                                    $qop->questions_id = $model->id;
                                                    $qop->option = Yii::app()->input->stripClean($_POST['option'.$i]);
                                                    $qop->save();
                                              }
                                              $this->redirect(array('questions/view'));
                                        }
			}
		}
		$this->render('updateques',array('model'=>$model,'from_page'=>'add','options'=>$options));
	}
}