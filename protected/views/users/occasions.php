<?php
//echo '<pre>';print_r($friends_occasions); die;
if(!empty($freinds_occasions))
{
	foreach($freinds_occasions as $oca_key=>$oca_values)
	{
	?>
		<div class="gift">
			<div class="f_l">
				<?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/images/gift.png'); ?>
			</div>
			<div class="f_l">
				<p><?php echo $oca_values['occasion_name'];?></p>
				<p><span><?php echo $oca_values['occasion_date'];?></span></p>
				<div class="f_l m_r_10"><i class="icon-time jreminder" user_remind_date="<?php echo $oca_values['remind_date'];?>" user_occ_id="<?php echo $oca_values['user_occ_id'];?>"></i></div>
				<div class="f_l m_r_10"><i class="icon-gift"></i></div>
				<div class="f_l m_r_10"><i class="icon-fb jinvite" ></i></div>
				<div class="f_l m_r_10"><i class="icon-none jhideocc" user_occ_id =<?php echo $oca_values['user_occ_id'];?>></i></div>
			</div>
		</div>
	<?php	
	}
}
else
{
?>
	<div class="alert">No Occasions in this month</div>
<?php
}

?>

