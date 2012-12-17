<?php
//echo '<pre>';print_r($friends_occasions); die;
if(!empty($freinds_notifications))
{
	$div_over_flow_cls = 'gift_sec';
	if(count($freinds_notifications)> 5)
	{
		$div_over_flow_cls = 'gift_over';	
	}
?>
	<div class="<?php echo $div_over_flow_cls;?>">
<?php  	
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
                <!--<div class="f_l m_r_10"><i class="icon-time"></i></div>-->
                <div class="f_l m_r_10"><i class="icon-gift"></i></div>
                <div class="f_l m_r_10"><i class="icon-fb"></i></div>
                <div class="f_l m_r_10"><i class="icon-none"></i></div>
            </div>
        </div>
	<?php	
	}
?>	
	</div>
<?php 	
}
else
{
?>

	<div class="alert">No Notifications exist</div>
<?php
}

?>

<script type="text/javascript">
	$(function() {
		$('.gift_over').scrollbars();
	});
</script>