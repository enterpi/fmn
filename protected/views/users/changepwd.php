<?php
/* @var $this ChangePasswordController */
/* @var $model ChangePassword */
/* @var $form CActiveForm */
?>
<?php 
       $cs=Yii::app()->getClientScript(); 
       Yii::app()->clientScript->registerCoreScript('jquery');  
?>
<div class="form">
<div class="update_pro">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'change-password-changepwd-form',
	'enableAjaxValidation'=>false,
)); ?>

	 <!-- <p class="note">Fields with <span class="required">*</span> are required.</p> -->
    
    <h2 class="update_head">Change Password</h2>

	<?php /* echo $form->errorSummary($model); */ ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'current_password'); ?>
		<?php echo $form->passwordField($model,'current_password',array('class'=>'inp','maxlength'=>255)); ?>
		<?php echo $form->error($model,'current_password'); ?>
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


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn_fgt')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->