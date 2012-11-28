
$('#Users_year,#Users_month').live('change',function(){
   var year = $('#Users_year').val();
   var month = $('#Users_month').val();
   var date = $('#Users_date').val();
   if(year == '')
   {
	   var theDate=new Date()
       year = theDate.getFullYear();
   }
   numberOfDays(year,month,date); 
});
function numberOfDays(year, month, date) {
    year = typeof(year)!= 'undefined' ? year : 0;
    month = typeof(month)!= 'undefined' ? month : 0;
	date = typeof(date)!= 'undefined' ? date : 0;
    if(year!=0 && month!=0)
    {
        var d = new Date(year, month, 0);
        var n = d.getDate();
        var html = '';
        for(i=1;i<=n;i++)
        {
            var sel = '';
			if(date == i) { sel = 'selected = selected'; }
			html+='<option value='+i+' '+ sel+'>'+i+'</option>';
        }
        $('#Users_date').html(html)
    }
    
}