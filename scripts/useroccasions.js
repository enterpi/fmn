// JavaScript Document

$(document).ready(function(){
	
	
	
    getOccasions(p_month,user_id);
    getNotifications(p_month,user_id);
	
    // loading Occasions and notification on pageload
    $('.jgetocc').click(function(){
		$('.popover').hide();						 
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
        var qry_string = 'p_month='+p_month+'&user_id='+user_id+'&FMN_TOKEN='+fmn_token;
        $.ajax({
            type: 'POST',
            url: base_url+'/users/GetOccasions',
            data: qry_string,
            beforeSend: function(){
                $('.jdisplayocc').html('<div class="loader">&nbsp;</div>');
            },
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
        var qry_string = 'p_month='+p_month+'&user_id='+user_id+'&FMN_TOKEN='+fmn_token;
        $.ajax({
            type: 'POST',
            url: base_url+'/users/getNotifications',
            data: qry_string,
            beforeSend: function(){
                $('.jdisplaynotifications').html('<div class="loader">&nbsp;</div>');
            },
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
            var qry_string = 'occ_id='+usr_occ_id+'&sts_value='+sts_value+'&FMN_TOKEN='+fmn_token;
            //don't delete below commented code
            $.ajax({
                type: 'POST',
                url: base_url+'/users/hideOccasions',
                data: qry_string,
                beforeSend: function(){ },
                success: function(res){
                    //$('.jhideoccpop').html('');
                    //getOccasions(p_month,user_id);
                   setTimeout(function(){
                       $('.popover').hide('slow');
                    }, 500);
                    
					setTimeout(function(){
                        $('.jgetocc.active').trigger('click'); // trigger click the active button to get the details of that particular month
                    }, 1000);
					
                },
                error: function(sts,txt,res){
                },
                complete: function(){
                }
            });
        }
        else
        {
            //$('.jhideoccpop').html('');
			//setTimeout(function(){
				$('.popover').hide('slow');
			//}, 1000);
        }
    });
	
    $('.jpopovercls.jclose').live('click',function(){
        $('.jhideoccpop').html('');
        $("#jinvtediv").remove();
    });
			
    // user occasion reminder functionality
    $('.jreminder').live('click',function(){
        $('.jpopovercls.jclose').trigger('click');
        var top_left_lgt = $(this).offset();
        var user_occ_id = $(this).attr('user_occ_id');
        var user_remind_date = $(this).attr('user_remind_date');
		var currentTime = new Date()
		var month = currentTime.getMonth() + 1
		var day = currentTime.getDate()
		var year = currentTime.getFullYear()
		var curr_date = month + "/" + day + "/" + year;
		
        var popovercontent = '<div class="popover-content">\
                             <p>Remind occasion on</p>\
                             <div class="m_t_10">\
                             <div class="input-append date f_l m_r_10" id="dp3" data-date="'+curr_date+'" data-date-format="mm/dd/yyyy">\
                                    <input class="span2 bday jremind_date" size="16" type="text" value="'+user_remind_date+'" readonly>\
                                    <span class="add-on"><i class="icon-th"></i></span>\
                             </div>\
                             <div class="m_t_10"><input class="btn remind m_b_10 f_l jremind" type="button" name="send" value="Set Reminder" id="setremainder" user_occ_id="'+user_occ_id+'"></div>\
                             <div class="jmsg"></div>\
                            </div></div>';
        $('.jhideoccpop').html($.showpopover({
            popovercontent:popovercontent,
            popoverheader:'Remind me',
            height:'150px',
            width:'350px',
            left:top_left_lgt.left+'px',
            top:top_left_lgt.top+'px'
			
        }));
        //$('#dp3').datepicker('autoclose',true);
		//$('#dp3').datepicker({'setStartDate':'12/08/2012'});
		
		$('#dp3').datepicker(
    	{"format": "mm/dd/yyyy", "startDate":curr_date, "autoclose": true});
    });
    
    $('.jinvite').live('click',function(){
        $('.jpopovercls.jclose').trigger('click');
        var top_left_lgt = $(this).offset();
        var user_occ_id = $(this).attr('user_occ_id');
        var popovercontent = '<div class="popover-content">\
                             <div class="m_t_5">\
                             <div class="m_r_10">\
                                    <label><p>Email</p>\
									<input id="sendinvite" class="inp" size="16" type="text" autofocus=true></label>\
                             </div>\
                             <div class="jmsg"></div>\
							 <div class="m_t_5"><input class="btn remind" type="button" name="send" value="Send Invitation" id="sendinvitation" ></div>\
                             </div></div>';
        var $div = $('<div />').appendTo('body');
        $div.attr('id', 'jinvtediv');
        $('#jinvtediv').html($.showpopover({
            popovercontent:popovercontent,
            popoverheader:'Invite Friend',
           	height:'auto',
            width:'340px',
            left:top_left_lgt.left+'px',
            top:top_left_lgt.top+'px'
			
        }));
		
    });
    
    $("#sendinvitation").live("click",function(){
        if($('#sendinvite').val() == '')
        {
            $('.jmsg').html('Please Enter email Id').css('color','red');
            $('#sendinvite').focus();
            return false;
        }
		var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
		var valid = emailRegex.test($('#sendinvite').val());
		if (!valid) 
		{
			$('.jmsg').html('Please Enter Valid email Id').css('color','red');
            $('#sendinvite').focus();
			return false;
		} 
        var qry_string ={
                'emailid':$("#sendinvite").val(),
                'for':'email_invite',
                'FMN_TOKEN':fmn_token
                } ;
        $.ajax({
            type: 'POST',
            url: base_url+'/users/sendinvite',
            data: qry_string,
            beforeSend: function(){ 
			$('.jmsg').html('');
			
			},
            success: function(res){
                if(res == 'success')
                {
                    $('.jmsg').html('Invitation Sent Successfully').css('color','black');
                    setTimeout(function(){
                        $('.popover').hide('slow');
                    }, 2000);
                }
                else
                {
                    $('.jmsg').html('Unable to send mail... Please try again later').css('color','red');
                }
            },
            error: function(sts,txt,res){
            },
            complete: function(){
            }
        });
        
            
    });

    //user occasion hide functionality
    $('.jremind').live('click',function(){
            if($('.jremind_date').val() == '')
            {
                $('.jmsg').html('Please select a reminder date').css('color','red');
                $('.jremind_date').focus();
                return false;
            }
			var remind_date = $('.jremind_date').val();
			var occ_id = $(this).attr('user_occ_id');
			//alert(remind_date);
            var qry_string ={
                'occ_id':$(this).attr("user_occ_id"),
                'remind_date':remind_date,
                'FMN_TOKEN':fmn_token
                } ;
            //don't delete below commented code
            $.ajax({
                type: 'POST',
                url: base_url+'/users/saveReminder',
                data: qry_string,
                beforeSend: function(){ },
                success: function(res){
					$('.jreminder[user_occ_id='+occ_id+']').attr('user_remind_date',remind_date);
                    if(res == 'success')
                    {
                        $('.jmsg').html('Reminder Set Successfully');
                        setTimeout(function(){
                            $('.popover').hide('slow');
                        }, 2000);
                        getNotifications($('.jgetocc.active').attr('month'),$('.jgetocc.active').attr('user_id'));
                    }
					
					
                },
                error: function(sts,txt,res){
                },
                complete: function(){
                }
            });
    });
	
	 $('.day').live('click',function(){
									 alert('hiii');
	 	//$('.datepicker').hide('slow')
	 });
	

});
	
