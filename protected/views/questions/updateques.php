<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
$cancel_link = 'questions/view';
$btn_name = 'Update';
if($from_page == 'add')
{
	$btn_name = 'Add';
}

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
      <li><?php echo CHtml::link('Users',Yii::app()->baseUrl.'/users/admin'); ?></li>
      <li class="active"><?php echo CHtml::link('Questions',Yii::app()->baseUrl.'/questions/view'); ?></li>
    </ul>
</div>

<div class="form">
<div class="update_pro">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'questions-update-form',
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p> -->
    <h2 class="update_head"><?php echo $btn_name;?> Quesstion</h2>
    
	<div class="row">
		<?php echo $form->labelEx($model,'question'); ?>
		<?php echo $form->textArea($model,'question',array('class'=>'inp', 'autofocus'=>true)); ?>
		<?php echo $form->error($model,'question'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
                <?php 
                    echo $form->dropDownList($model, 'status',
                                    array('1' => 'Active', '0' => 'Inactive'),
                                    array('empty' => 'Select')
                                ); 
                ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'option1'); ?>
		<?php echo CHtml::textField(!empty($options[0]['id'])?$options[0]['id']:'option1', $options[0]['option']); ?>
		<?php echo $form->error($model,'option1'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'option2'); ?>
		<?php echo CHtml::textField(!empty($options[1]['id'])?$options[1]['id']:'option2', $options[1]['option']); ?>
		<?php echo $form->error($model,'option2'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'option3'); ?>
		<?php echo CHtml::textField(!empty($options[2]['id'])?$options[2]['id']:'option3', $options[2]['option']); ?>
		<?php echo $form->error($model,'option3'); ?>
	</div>


	<div class="row buttons">
                <?php echo CHtml::button('Cancel', array('submit' => array($cancel_link),'class'=>'btn btn_fgt m_r_10')); ?>
		<?php echo CHtml::submitButton($btn_name,array('class'=>'btn btn_fgt')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->