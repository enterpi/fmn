<?php
//echo '<pre>';print_r($friends_occasions); die;
if(!empty($freinds_occasions))
{
	$div_over_flow_cls = 'gift_sec';
	if(count($freinds_occasions)> 10)
	{
		$div_over_flow_cls = 'gift_over';	
	}
			
?>
	<div class="<?php echo $div_over_flow_cls;?>">
<?php    
	foreach($freinds_occasions as $oca_key=>$oca_values)
	{
	?>
		<div class="gift">
			<div class="f_l avtaar">
				<?php
				$profile_img_path = ($oca_values['profile_img_path']!=''?$oca_values['profile_img_path']:Yii::app()->request->baseUrl.'/css/images/gift.png');
				//echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/gift.png'); 
				echo CHtml::image($profile_img_path); 
				?>
			</div>
			<div class="f_l">
				<p><?php echo $oca_values['occasion_name'];?></p>
				<p><span><?php echo $oca_values['occasion_date'];?></span></p>
				<div class="f_l m_r_10"><i class="icon-time jreminder" title="Remind me" user_remind_date="<?php echo ($oca_values['remind_date']=='00/00/0000'?'':$oca_values['remind_date']);?>" user_occ_id="<?php echo $oca_values['user_occ_id'];?>"></i></div>
				<div class="f_l m_r_10"><i class="icon-gift c_n" title="Send Gift"></i></div>
				<div class="f_l m_r_10"><i class="icon-fb jinvite" title="Invite Friend" ></i></div>
				<div class="f_l m_r_10"><i class="icon-none jhideocc" title="Hide Occasions" user_occ_id =<?php echo $oca_values['user_occ_id'];?>></i></div>
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
	<div class="alert">No Occasions in this month</div>
<?php
}

?>

<script type="text/javascript">
	$(function() {
		$('.gift_over').scrollbars();
	});
</script>

