<!DOCTYPE html>
<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
	</script>

 </head>
<body>

<script>

 // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
   alert('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      alert('you are loged in and connected');
		testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      alert('you are logedin but not connectd');
		document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      alert('you are not loged in at all');
		document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  function checkLoginState() {
    alert('colled checkLoginState');
	FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1822800737957483',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });
	
  FB.getLoginStatus(function(response) {
	  alert('in window fb.getLoginStatus response sen statusChangeCallback');
    statusChangeCallback(response);
  });

  };

  //1 Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,gender,picture.with(15).height(150)'}, function(response) {
		console.log('Successful login for: ' + response.last_name);
		var name = response.name;
		var fbId = response.id;
		var picture = response.picture.data.url;
		//var gender = gender;
		var thisid = 1;
		$.ajax({
			  type : "GET",
			  url : "scripts/savefacebook.php",
			  dataType : "html",
			  cache : "false",
			  data : {
				name : name,
				fbId : fbId,
				//gender : gender,
				thisid : thisid,
			  },
			  success : function(html, textStatus){
				//$("#soza").html(html);
				document.getElementById('soza').innerHTML = '';
			},
			  error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
				alert('Errors only');
			  }
		  });
		  alert();
		document.getElementById('status').innerHTML = '<h3>Great, '+name+' your profile is updated</h3><br/><h3><a href="home">Click Here</a></h3><hr/><img src="'+picture+'">';
		FB.logout(function(response) {
		  // user is now logged out
		});
   });
  }
</script>
<!-- FACEBOOK FILL INFORMATION-->


	<div id="status">
	</div>

	<div id="soza">

	<div id='login' onlogin="checkLoginState();"><img src="assets/images/fb.png" style="cursor: pointer;"/></div>
	</div>
<script>
(function ($) {
$(function () {
	$("#login img").on("click", function () {
		FB.login(function(response) {
			if (response.authResponse) {
				testAPI();
			}
		});
	});
});
})(jQuery);
</script>
</body>
</html>