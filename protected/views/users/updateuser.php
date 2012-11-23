<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<?php 
       $cs=Yii::app()->getClientScript(); 
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/jquery.js');
       $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/slider/slider.css');
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/slider/coin-slider.js');
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/numberofdays.js');
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-updateuser-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name'); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name'); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_address'); ?>
		<?php echo $form->textField($model,'email_address'); ?>
		<?php echo $form->error($model,'email_address'); ?>
	</div>
	
        <div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
                <?php 
                    $years = array();
                    $months = array();
                    $dates = array();
                    $curr_year = date('Y',strtotime($model->birthday));
                    $curr_date = date('j',strtotime($model->birthday));
                    $curr_month = date('n',strtotime($model->birthday));
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
                                    array('m' => 'male', 'f' => 'female','o'=>'other'),
                                    array('empty' => 'Select')
                                ); 
                ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'physical_address'); ?>
		<?php echo $form->textField($model,'physical_address'); ?>
		<?php echo $form->error($model,'physical_address'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->