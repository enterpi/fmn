// JavaScript Document

$(document).ready(function(){
	
	
	
	getOccasions(p_month,user_id);
	getNotifications(p_month,user_id);
	
	// loading Occasions and notification on pageload
	$('.jgetocc').click(function(){
		$('.jgetocc').removeClass('active');
		$(this).addClass('active');
		var p_month = $(this).attr("month");
		var user_id = $(this).attr("user_id");
		getOccasions(p_month,user_id);
		getNotifications(p_month,user_id);
		
	});
	
	//Getting friends occasions data
	function getOccasions(p_month,user_id)
	{
		var qry_string = 'p_month='+p_month+'&user_id='+user_id;
		$.ajax({
			type: 'POST',
			url: base_url+'/users/GetOccasions',
			data: qry_string,
			beforeSend: function(){ $('.jdisplayocc').html('<div class="loader">&nbsp;</div>'); },
			success: function(res){
				$('.jdisplayocc').html(res);
			},
			error: function(sts,txt,res){
			},
			complete: function(){
			}
		});
	}
	
	//Getting friends Notifications data
	function getNotifications(p_month,user_id)
	{
		var qry_string = 'p_month='+p_month+'&user_id='+user_id;
		$.ajax({
			type: 'POST',
			url: base_url+'/users/getNotifications',
			data: qry_string,
			beforeSend: function(){ $('.jdisplaynotifications').html('<div class="loader">&nbsp;</div>'); },
			success: function(res){
				$('.jdisplaynotifications').html(res);
			},
			error: function(sts,txt,res){
			},
			complete: function(){
			}
		});
	}
	
	//user occasion hide popover functionality
	$('.jhideocc').live('click',function(){
		
		var top_left_lgt = $(this).offset();	
		var popovercontent = '<div class="popover-content">\
							 <p>Hide this occasion in the future</p>\
							 <div class="gen_sel">\
							 <div class="f_l occa_w"><input type="radio" name="grp" value="y" user_occ_id = "'+$(this).attr("user_occ_id")+'" class="jhide_occ"/> Yes </div>\
							 <div class="f_l occa_w"><input type="radio" name="grp" value="n" user_occ_id = "'+$(this).attr("user_occ_id")+'" class="jhide_occ"/> No </div>\
							 </div></div>';
		$('.jhideoccpop').html($.showpopover({
			
			popovercontent:popovercontent,
			popoverheader:'Hide Occasion',
			height:'130px',
			width:'300px',
			left:top_left_lgt.left+'px',
			top:top_left_lgt.top+'px'
			
		}));
	});
	
	//user occasion hide functionality
	$('.jhide_occ').live('click',function(){
	
		var usr_occ_id = $(this).attr("user_occ_id");
		var sts_value = $(this).val();
		if(sts_value == 'y')
		{
			var qry_string = 'occ_id='+usr_occ_id+'&sts_value='+sts_value;
			//don't delete below commented code
			$.ajax({
				type: 'POST',
				url: base_url+'/users/hideOccasions',
				data: qry_string,
				beforeSend: function(){ },
				success: function(res){
					$('.jhideoccpop').html(''); 
					getOccasions(p_month,user_id);
				},
				error: function(sts,txt,res){
				},
				complete: function(){
				}
			});
		}
		else
		{
			$('.jhideoccpop').html('');
		}
	});
	
	$('.jpopovercls.jclose').live('click',function(){
		$('.jhideoccpop').html(''); 
	});
			
	// user occasion reminder functionality
	$('.jreminder').live('click',function(){
		$('.jpopovercls.jclose').trigger('click');
		var top_left_lgt = $(this).offset();	
		var popovercontent = '<div class="popover-content">\
							 <p>Remind occasion on</p>\
							 <div class="m_t_10">\
							 <div class="input-append date f_l m_r_10" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">\
							 	<input class="span2 bday" size="16" type="text" value="12-02-2012">\
							 	<span class="add-on"><i class="icon-th"></i></span>\
							 </div>\
							 <div class="m_t_10"><input class="btn remind m_b_10" type="button" name="send" value="Set Reminder" id="sendpwd"></div>\
							 </div></div>';
		$('.jhideoccpop').html($.showpopover({
			
			popovercontent:popovercontent,
			popoverheader:'Remind me',
			height:'150px',
			width:'340px',
			left:top_left_lgt.left+'px',
			top:top_left_lgt.top+'px'
			
		}));
		$('#dp3').datepicker();	
		
	});
});
	
