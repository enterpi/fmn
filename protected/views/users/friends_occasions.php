<?php
/* @var $this UsersController */
/* @var $model Users */
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

//echo '<pre>';print_r($freinds_occasions); die;
/* $this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
); */


$months = array(1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
?>
<script>
var user_id = '<?php echo $user_id;?>';
var p_month = '<?php echo $p_month;?>';
var base_url = '<?php echo Yii::app()->request->baseUrl; ?>';
var fmn_token = '<?php echo Yii::app()->request->csrfToken; ?>';
</script>


<?php 
       $cs=Yii::app()->getClientScript(); 
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/popover.js');
       $cs->registerScriptFile(Yii::app()->request->baseUrl.'/scripts/useroccasions.js');
       Yii::app()->clientScript->registerScript('questions','
        function question(questions)
        {
            if(typeof(questions.length)!="undefined" && questions.length>0)
            {
                random_number = Math.floor(Math.random()*questions.length);
                var question =  questions[random_number];
                var html=\'<h3 class="m_t_15">\'+question.question+\'</h3>\';
                    html+=\'<div class="answer">\';
                    html+=  \'<input id="user_question" type="hidden" name="question" value="\'+question.question_id+\'" />\';
                    $.each(question.options,function(index,value){
                        html+=  \'<div class="opt1">\';
                        html+=  \'<label><input class="user_answer" type="checkbox" name="question_option" value="\'+value.id+\'" />\'+value.option+\'</label>\'; 
                        html+=  \'</div>\'; 
                    });

                    html+=  \'</div>\';

                    $("#question").html(html);
                }
        }
        
        var questions = \''.$questions.'\';
        questions = JSON.parse(questions);
        if(questions.length>0)
        question(questions);
        else
        $("#question").html(\'<h3 class="m_t_15">All questions have been answered</h3>\');
        setInterval(function(){question(questions)}, 15000);
        $(".user_answer").live("click",function(){
            var qry_string ={"answer":$(this).val(),"question":$("#user_question").val(),"FMN_TOKEN":"'.Yii::app()->request->csrfToken.'"} ;
            $.ajax({
                type: "POST",
                url: "'.Yii::app()->request->baseUrl.'/users/saveanswer/",
                data: qry_string,
                beforeSend: function(){},
                success: function(res){
                    questions.splice(random_number,1);
                    if(questions.length>0){
                        if(res=="success")
                            question(questions);
                    }
                    else{
                        $("#question").html(\'<h3 class="m_t_15">All questions have been answered</h3>\');
                    }
                        
                },
                error: function(sts,txt,res){
                },
                complete: function(){
                }
            });
            
        });
        ');
?>
<div class="wrapper_home">
<div class="jhideoccpop"></div>
    <div class="wrapper_left">
        <div id="question" class="question"> 
            
        </div>
        
        <div class="upcoming">
            <div class="month_head m_t_25">
                <h2 class="f_l">Upcoming</h2>
                <ul>
                 <?php 
				 foreach($months as $mon_key=>$mon_val)
				 {
					 $active_class = '';
					 if($mon_key == $p_month)
					 {
						 $active_class = 'active';
					 }
					  echo '<li><a class="'.$active_class.' jgetocc" month='.$mon_key.' user_id='.$user_id.'>'.$mon_val.'</a></li>';
				 }
				 ?>   
                </ul>
            </div>
        </div>
        <div class="preview">
            <div class="prev_head m_b_20">
                <p><a href="#">ADD OCCASION</a> | 
                <a href="#">FIND A GIFT</a></p>
            </div>
            <div class="gift_sec jdisplayocc">
                <!-- Displying Occasions Data-->
            </div>
        </div>
        <div class="month_head m_t_15 m_b_20">
            <h2 class="f_l">Notifications</h2>
        </div>
        <div class="gift_sec jdisplaynotifications">
        	 <!-- Displying Notifications Data-->
        </div>
    </div>
    <div class="wrapper_right">
        <div class="right_head">FOR YOU</div>
        <div>
        	<div class="m_t_25"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/gift1.png'); ?></div>
            <div class="m_t_25"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/gift2.png'); ?></div>
            <div class="m_t_25"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/gift3.png'); ?></div>
        </div>
    </div>
</div>




