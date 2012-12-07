<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<?php 
       $cs=Yii::app()->getClientScript(); 
       Yii::app()->clientScript->registerCoreScript('jquery');  
       $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/slider/slider.css');
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/slider/coin-slider.js');
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/numberofdays.js');
?>

<div class="admin_menu">
    <ul class="nav nav-tabs m_b_0">
      <li class="active"><?php echo CHtml::link('Users',Yii::app()->baseUrl.'/users/admin'); ?></li>
      <li><?php echo CHtml::link('Questions',Yii::app()->baseUrl.'/questions/view'); ?></li>
    </ul>
</div>
<div class="form">
    <div class="update_pro">
    	<div class="form login_sec">
            <div class="signin_sec">
            	<h2 class="update_head">Add User</h2>
                
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'users-addUser-form',
            'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
        )); ?>
        
        
            <?php /* echo $form->errorSummary($model); */ ?>
        
            <div class="row">
                <?php echo $form->labelEx($model,'first_name'); ?>
                <?php echo $form->textField($model,'first_name',array('class'=>'inp','maxlength'=>255)); ?>
                <?php echo $form->error($model,'first_name'); ?>
            </div>
        
            <div class="row">
                <?php echo $form->labelEx($model,'last_name'); ?>
                <?php echo $form->textField($model,'last_name',array('class'=>'inp','maxlength'=>255)); ?>
                <?php echo $form->error($model,'last_name'); ?>
            </div>
        
            <div class="row">
                <?php echo $form->labelEx($model,'email_address'); ?>
                <?php echo $form->textField($model,'email_address',array('class'=>'inp','maxlength'=>255)); ?>
                <?php echo $form->error($model,'email_address'); ?>
            </div>
        
            <div class="row">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password',array('class'=>'inp','maxlength'=>255)); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>
                <div class="row">
                <?php echo $form->labelEx($model,'confirm_password'); ?>
                <?php echo $form->passwordField($model,'confirm_password',array('class'=>'inp','maxlength'=>255)); ?>
                <?php echo $form->error($model,'confirm_password'); ?>
            </div>
        
            <div class="row">
                <?php echo $form->labelEx($model,'birthday'); ?>
                        <?php /*$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model'=>$model,
                                'attribute'=>'birthday',
                                'name'=>'Users[birthday]',
                                'options'=>array(
                                'showAnim'=>'fold',
                                ),
                                'htmlOptions'=>array(
                                    'style'=>'height:20px;',
                                    'class'=>'inp',
                                ),
                                
                            )); */?>
                            <?php 
                            $years = array();
                            $months = array();
                            $dates = array();
                            $curr_year = date('Y');
                            $curr_date = date('j');
                            $curr_month = date('n');
                            //$num = cal_days_in_month(CAL_GREGORIAN, $curr_month, $curr_year);
                            $num= 31;
                            for($i=$curr_year;$i>=1905;$i--)
                            {
                                $years[$i] = $i;
                            }
                            $months = array(1 => 'Jan', 
                                            2 => 'Feb', 
                                            3 => 'Mar', 
                                            4 => 'Apr', 
                                            5 => 'May', 
                                            6 => 'Jun', 
                                            7 => 'Jul', 
                                            8 => 'Aug', 
                                            9 => 'Sep', 
                                            10 => 'Oct', 
                                            11 => 'Nov', 
                                            12 => 'Dec');
                            for($i=1;$i<=$num;$i++)
                            {
                                $dates[$i] = $i;
                            }
                            echo $form->dropDownList($model, 'date',
                                                $dates,
                                                //array('class'=>'bday'),
                                                array('empty' =>'Date','class'=>'bday')
                                            ); 
                             echo $form->dropDownList($model, 'month',
                                                $months,
                                                //array(),
                                                array('empty' =>'Month','class'=>'bday')
                                            ); 
                            echo $form->dropDownList($model, 'year',
                                                $years,
                                                //array('class'=>'bday'),
                                                array('empty' =>'Year','class'=>'bday')
                                            ); 
                           
                            
                            echo $form->error($model,'birthday'); ?>
            </div>
        
            <div class="row">
                <?php echo $form->labelEx($model,'gender'); ?>
                        <?php 
                            echo $form->dropDownList($model, 'gender',
                                            array('male' => 'Male', 'female' => 'Female','other'=>'Other'),
                                            array('empty' => 'Select')
                                        ); 
                        ?>
                <?php echo $form->error($model,'gender'); ?>
            </div>
        
            <div class="row">
                <?php echo $form->labelEx($model,'physical_address'); ?>
                <?php echo $form->textArea($model,'physical_address',array('class'=>'inp','maxlength'=>255)); ?>
                <?php echo $form->error($model,'physical_address'); ?>
            </div>
            
        
            <div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save' ,array('class'=>'btn btn_fgt')); ?>
                <?php echo CHtml::button('Cancel', array('submit' => array('users/admin'),'class'=>'btn btn_fgt')); ?>
            </div>
        
        <?php $this->endWidget(); ?>
        </div>
        </div><!-- form -->
    </div>
</div><!-- form -->