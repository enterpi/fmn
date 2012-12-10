// JavaScript Document

$.extend({
		 
		 showpopover:function(data){
					 var config = {
						popovercss:'',
						popoverheader:'',
						popovercontent:'',
						left:'',
						top:'',height:'',
						width:''
						
					 };
					 if(data) $.extend(config,data);
					 
					 var popover= [];
					 popover.push('<div class="popover fade right in" style="top:'+config.top+';left:'+config.left+';height:'+config.height+';width:'+config.width+'"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title">'+config.popoverheader+'</h3><div class="popover-content">'+config.popovercontent+'</div></div>');

					popover.push('<a class="popover_cls jpopovercls jclose"></a>');	
					popover.push('</div>');
					
					return popover.join("");
			 }
		 });

