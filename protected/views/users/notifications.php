<?php
//echo '<pre>';print_r($friends_occasions); die;
if(!empty($freinds_notifications))
{
	foreach($freinds_notifications as $noti_key=>$noti_values)
	{
	?>
		<div class="gift gift1">
            <div class="f_l">
                <?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/gift.png'); ?>
            </div>
            <div class="f_l">
                <p>><?php echo $noti_values['occasion_name'];?></p>
                <p><span><?php echo $noti_values['occasion_date'];?></span></p>
                <div class="f_l m_r_10"><i class="icon-time"></i></div>
                <div class="f_l m_r_10"><i class="icon-gift"></i></div>
                <div class="f_l m_r_10"><i class="icon-fb"></i></div>
                <div class="f_l m_r_10"><i class="icon-none"></i></div>
            </div>
        </div>
	<?php	
	}
}
else
{
	echo 'No Notifications exist';
}

?>