<?php
//echo '<pre>';print_r($friends_occasions); die;
if(!empty($freinds_notifications))
{
	foreach($freinds_notifications as $noti_key=>$noti_values)
	{
	?>
		<div class="gift gift1">
            <div class="f_l avtaar">
                <?php 
				$profile_img_path = ($noti_values['profile_img_path']!=''?$noti_values['profile_img_path']:Yii::app()->request->baseUrl.'/css/images/gift.png');
				//echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/gift.png'); 
				echo CHtml::image($profile_img_path); 
				?>
            </div>
            <div class="f_l">
                <p><?php echo $noti_values['occasion_name'];?></p>
                <p><span><?php echo $noti_values['occasion_date'];?></span></p>
                <!--<div class="f_l m_r_10"><i class="icon-time" title="Remind Me"></i></div>-->
                <div class="f_l m_r_10"><i class="icon-gift c_n" title="Send Gift"></i></div>
                <div class="f_l m_r_10"><i class="icon-fb c_n" title="Invite Friend"></i></div>
                <div class="f_l m_r_10"><i class="icon-none c_n" title="Hide Occasions"></i></div>
            </div>
        </div>
	<?php	
	}
}
else
{
?>

	<div class="alert">No Notifications exist</div>
<?php
}

?>