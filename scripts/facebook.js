/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


// Additional JS functions here
window.fbAsyncInit = function() {
    FB.init({
      //appId      : '295666597209912', // App ID
	  appId      : '520916744599369', // App ID
      //channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });
    

    // Additional init code here
    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        // connected
      } else if (response.status === 'not_authorized') {
        // not_authorized
        login();
        
      } else {
        // not_logged_in
        //login();
      }
     });
     
    

    };

    // Load the SDK Asynchronously
    (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
}(document));


