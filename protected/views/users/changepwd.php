<?php
/* @var $this ChangePasswordController */
/* @var $model ChangePassword */
/* @var $form CActiveForm */
?>
<?php 
       $cs=Yii::app()->getClientScript(); 
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/jquery.js');
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'change-password-changepwd-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'current_password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'confirm_password'); ?>
		<?php echo $form->passwordField($model,'confirm_password'); ?>
		<?php echo $form->error($model,'confirm_password'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->