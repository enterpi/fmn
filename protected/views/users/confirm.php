<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

/* $this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
); */
?>
<?php 
       $cs=Yii::app()->getClientScript(); 
       $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/slider/slider.css');
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/slider/coin-slider.js');
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/numberofdays.js');
?>

<div class="wrapper_home">
	
	<div class="login_sec">
		<div class="confirmation alert-info">
        	<?php
            
            /*
             * To change this template, choose Tools | Templates
             * and open the template in the editor.
             */
            echo "An e-mail has been sent to<br /> ".$email." <br /> Please click the activation link included in the email to activate your account.";
            ?>
         </div>
    </div>

    <div class="slider">
        <h3>Occasions remembered
        <span>and celebrated with personal, thoughtful gifts.</span></h3>
        <div id="slider">
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/slider/img1.png'); ?>
            <span>Important dates remembered...</span>
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/slider/img2.png'); ?>
            <span>Important dates remembered...</span>
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/slider/img3.png'); ?>
            <span>Important dates remembered...</span>
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/slider/img4.png'); ?>
            <span>Important dates remembered...</span>
        </div>
        <script>
            $('#slider').coinslider();
        </script>
    </div>
</div>