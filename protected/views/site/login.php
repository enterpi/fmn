<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php 
       $cs=Yii::app()->getClientScript(); 
       $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/slider/slider.css');
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/slider/coin-slider.js');
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/facebook.js');
?>
<div id="fb-root"></div>
<div class="form">
    <div class="wrapper_home">
        <div class="login_sec">
            <div class="fb_connect">
                            <a href="#" onClick="login()"><img src="<?php echo Yii::app()->request->baseUrl ?>/css/images/fbconnect.png" /></a>
                        <h6>we won’t post anything without your permission.</h6>
                    </div>
            <div class="option">
                            ----------- <span>or</span> -----------
                    </div> 
            <div class="signin_sec">
                    <div class="head">
                    <h2>Log in </h2>
                    <h3><?php echo CHtml::link('Don\'t have an account yet?',Yii::app()->baseUrl.'/users/create'); ?></h3>
                </div>
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                        ),
                )); ?>
                <div>
                    <label class ="labl">
                        <span>
                            <?php echo $form->labelEx($model,'username'); ?>
                        </span>
                        <span>
                            <?php echo $form->textField($model,'username',array('class'=>'inp')); ?>
                        </span>
                        <span>
                            <?php echo $form->error($model,'username'); ?>
                        </span>
                    </label>
                    <label class ="labl">
                        <span>
                            <?php echo $form->labelEx($model,'password'); ?>
                        </span>
                        <span>
                            <?php echo $form->passwordField($model,'password',array('class'=>'inp')); ?>
                        </span>
                        <span>
                            <?php echo $form->error($model,'password'); ?>
                        </span>
                    </label>
                    <!-- <label class="labl remember">
                            <?php /* echo $form->checkBox($model,'rememberMe'); */ ?>
                            <?php /* echo $form->label($model,'rememberMe'); */ ?>
                            <?php /* echo $form->error($model,'rememberMe'); */ ?>
                    </label> -->
                   
							<?php echo CHtml::submitButton('SIGN IN',array('class'=>'btn signin m_r_6')); ?>
                    <label class="labl">
                        <div class="pwd">
                            <a href="#data" rel="fpwd">FORGOT YOUR PASSWORD?</a>
                        </div>
                    </label>
                </div>
                <?php $this->endWidget(); ?>
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


</div><!-- form -->
<div style="display:none">
    <div id="data">
        <div class="heading">Forgot your password?</div>
        <div class="email_id_sec">
            <div class="sec2">
                <label>
                    <div class="lft_em">Email Id:</div>
                    <div class="rgt_em">
                        <input type="text" name="fp_email" id="fp_email" style="width:300px"/>
                        <span class="error">Please enter Email Id</span>
                    </div>
                </label>
            </div>
            <div class="sec3"><input class="btn btn_fgt m_b_10" type="button" name="send" value="Send" id="sendpwd" /></div>
        </div>
        <div><h2 class="sucess_msg"></h2></div>
    </div>
</div>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=fpwd]',
    //'config'=>array('autoDimensions'=>false,'width'=>'400','height'=>'100'),
    )
);
?>
<style>
    #data{
        font-size:13px;
		min-height:100px;
		min-width:377px;
    }
    .sec2{
        margin:20px 0 10px 0;
        overflow:hidden
    }
    .lft_em{ margin:6px 10px 0 0}
    .lft_em,.rgt_em{ float:left}
    .rgt_em input{ display:block; margin-bottom:2px}
    .sec3{
        text-align:center;
    }
    span.error{
        color:red;
        display:none;
    }
	h2.sucess_msg{
        color:red;
        display:none;
    }
</style>
<script>
    $(document).ready(function(){
        $('#sendpwd').click(function(){
            if($('#fp_email').val() == '')
            {
                $('#fp_email').focus();
                $('.error').show();
            }
            else
            {
                var qry_string = 'for=changepwd&emailid='+$('#fp_email').val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->request->baseUrl ?>/users/fpmail/',
                    data: qry_string,
                    beforeSend: function(){},
                    success: function(res){
                        if(res=='1')
                        {
                            $("#data .error").html('Incorrect Email id specified').show();
                        }
                       else if(res=='2')
					    {
                            $(".email_id_sec").hide();
							$("#data .sucess_msg").html('Reset password link has been sent to your Email').show();    
                        }
                        
                        //$('#fancybox-close').trigger('click');
                    },
                    error: function(sts,txt,res){
                    },
                    complete: function(){
                    }
                });
                
            }
        });
        $('#fp_email').keyup(function(){
            if($(this).val()!='')
            {
                $('#fp_email').closest('#data').find('.error').hide();
            }
            else
            {
                $('#fp_email').closest('#data').find('.error').show();
            }
        });
    });
</script>