<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form login_sec">
    <div class="signin_sec">
        <div class="head">
            <h2>Register </h2>
        </div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
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
                    $num = cal_days_in_month(CAL_GREGORIAN, 8, 2003);
                    for($i=1900;$i<=$curr_year;$i++)
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
                    echo $form->dropDownList($model, 'year',
                                        $years,
                                        array('options' =>array($curr_year=>array('selected'=>true)))
                                    ); 
                    ?>
                    <?php 
                    echo $form->dropDownList($model, 'month',
                                        $months,
                                        array('options' =>array($curr_month=>array('selected'=>true)))
                                    ); 
                    ?>
                    <?php 
                    echo $form->dropDownList($model, 'date',
                                        $dates,
                                        array('options' =>array($curr_date=>array('selected'=>true)))
                                    ); 
                    ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
                <?php 
                    echo $form->dropDownList($model, 'gender',
                                    array('m' => 'Male', 'f' => 'Female','o'=>'Other'),
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Sign Up' : 'Save' ,array('class'=>'btn signin')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->