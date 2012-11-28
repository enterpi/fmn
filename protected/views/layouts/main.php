<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <?php 
               $cs=Yii::app()->getClientScript(); 
               $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/bootstrap-modal.js');
	       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/bootstrap.js');
        ?>
        
   
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header" class="header">
		<div id="logo" class="logo_sec"><?php echo CHtml::link('<img src="'. Yii::app()->request->baseUrl .'/css/images/logo.png" alt="" />',array('/site/login')); ?></div>
    <?php
		if(!Yii::app()->user->isGuest){ ?>
            <div class="profile">
            	<div class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <div class="pro_pic">
                  	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/gift.png'); ?>
                  </div><?php 
				  
				  $name = UserIdentity::getUserDetails(Yii::app()->user->getId());
				  echo $name;?></a>
                  <ul class="dropdown-menu dro_menu" role="menu" aria-labelledby="dLabel">
                    <li><?php echo CHtml::link('Update Profile',array('/users/updateuser')); ?></li>
                    <li><?php echo CHtml::link('Change Password',array('/users/changepwd')); ?></li>
                    <li><?php echo CHtml::link('Logout',array('/site/logout')); ?></li>
                  </ul>
                </div>
            </div>
		<?php }
	?>

	</div><!-- header -->
	<div id="mainmenu">
		<?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Users ('.Yii::app()->user->name.')', 'url'=>array('/users'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Register', 'url'=>array('/users/create'), 'visible'=>Yii::app()->user->isGuest)
                        
			),
		));*/ ?>
	</div><!-- mainmenu -->
	<?php //if(isset($this->breadcrumbs)):?>
		<?php //$this->widget('zii.widgets.CBreadcrumbs', array(
			//'links'=>$this->breadcrumbs,
		//)); ?><!-- breadcrumbs -->
	<?php //endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	

</div><!-- page -->
<div id="footer" class="footer">
		<div class="foot_cont">
                        <ul class="first">
                        <li><a href="#">ABOUT</a></li>
                        <li><a href="#">HELP</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">PRIVACY POLICY</a></li>
                        <li><a href="#">TERMS OF SERVICE</a></li>
                    </ul>
                    <p><a href="#">CONTACT</a></p>
                </div>
	</div><!-- footer -->
 <script>
$(document).ready(function(){
	$('.dropdown-toggle').dropdown();
});

</script>
</body>
</html>
