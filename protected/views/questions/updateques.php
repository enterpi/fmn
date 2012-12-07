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
		<?php echo $form->textField($model,'question',array('class'=>'inp','maxlength'=>255)); ?>
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


	<div class="row buttons">
		<?php echo CHtml::submitButton($btn_name,array('class'=>'btn btn_fgt')); ?>
         <?php echo CHtml::button('Cancel', array('submit' => array($cancel_link),'class'=>'btn btn_fgt')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->