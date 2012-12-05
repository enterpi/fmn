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
                    $('.jhideoccpop').html('');
                    //getOccasions(p_month,user_id);
                    $('.jgetocc.active').trigger('click'); // trigger click the active button to get the details of that particular month
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
        $("#jinvtediv").remove();
    });
			
    // user occasion reminder functionality
    $('.jreminder').live('click',function(){
        $('.jpopovercls.jclose').trigger('click');
        var top_left_lgt = $(this).offset();
        var user_occ_id = $(this).attr('user_occ_id');
        var user_remind_date = $(this).attr('user_remind_date');
        var popovercontent = '<div class="popover-content">\
                             <p>Remind occasion on</p>\
                             <div class="m_t_10">\
                             <div class="input-append date f_l m_r_10" id="dp3" data-date="12/02/2012" data-date-format="mm/dd/yyyy">\
                                    <input class="span2 bday jremind_date" size="16" type="text" value="'+user_remind_date+'">\
                                    <span class="add-on"><i class="icon-th"></i></span>\
                             </div>\
                             <div class="m_t_10"><input class="btn remind m_b_10 jremind" type="button" name="send" value="Set Reminder" id="setremainder" user_occ_id="'+user_occ_id+'"></div>\
                             <div class="jmsg"></div>\
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
    
    $('.jinvite').live('click',function(){
        $('.jpopovercls.jclose').trigger('click');
        var top_left_lgt = $(this).offset();
        var user_occ_id = $(this).attr('user_occ_id');
        var user_remind_date = $(this).attr('user_remind_date');
        var popovercontent = '<div class="popover-content">\
                             <p>Email</p>\
                             <div class="m_t_10">\
                             <div class="input-append date f_l m_r_10">\
                                    <input id="sendinvite" class="span2" size="16" type="text">\
                             </div>\
                             <div class="m_t_10"><input class="btn remind m_b_10" type="button" name="send" value="Send Invitation" id="sendinvitation" ></div>\
                             <div class="jmsg"></div>\
                            </div></div>';
        var $div = $('<div />').appendTo('body');
        $div.attr('id', 'jinvtediv');
        $('#jinvtediv').html($.showpopover({
            popovercontent:popovercontent,
            popoverheader:'Remind me',
            height:'150px',
            width:'340px',
            left:top_left_lgt.left+'px',
            top:top_left_lgt.top+'px'
			
        }));
		
    });
    
    $("#sendinvitation").live("click",function(){
        if($('.jremind_date').val() == '')
        {
            $('.jmsg').html('Please Enter and email Id').css('color','red');
            $('.jremind_date').focus();
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
            beforeSend: function(){ },
            success: function(res){
                if(res == 'success')
                {
                    $('.jmsg').html('Invite Sent Successfully');
                    setTimeout(function(){
                        $('.popover').hide('slow');
                    }, 2000);
                }
                else
                {
                    $('.jmsg').html('Please try again later');
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
            var qry_string ={
                'occ_id':$(this).attr("user_occ_id"),
                'remind_date':$('.jremind_date').val(),
                'FMN_TOKEN':fmn_token
                } ;
            //don't delete below commented code
            $.ajax({
                type: 'POST',
                url: base_url+'/users/saveReminder',
                data: qry_string,
                beforeSend: function(){ },
                success: function(res){
                    if(res == 'success')
                    {
                        $('.jmsg').html('Reminder Set Successfully');
                        setTimeout(function(){
                            $('.popover').hide('slow');
                        }, 2000);
                        getNotifications($('.jgetocc.active').attr('month'),$('.jgetocc.active').attr('user_id'));
                    }
                    else
                    {
                        $('.jmsg').html('Please try again later');
                    }
                },
                error: function(sts,txt,res){
                },
                complete: function(){
                }
            });
    });
});
	
