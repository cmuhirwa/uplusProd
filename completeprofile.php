<?php include "template/header.php"?>

<!-- Page -->
  <div class="page animsition">
   <div class="page-header">
      <h1 class="page-title">Please complete your Profile with Facebook:</h1><div class="page-header-actions">
        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-outline btn-round site-tour-trigger">
            <i class="icon md-info" aria-hidden="true"></i>
			<span class="hidden-xs"> I need Help </span>
        </a>
      </div>
    </div>
	<div class="page-content container-fluid">
  
<script>

 // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
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

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
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
		var gender = gender;
		var thisid = <?php echo $thisid;?>;
		$.ajax({
			  type : "GET",
			  url : "scripts/savefacebook.php",
			  dataType : "html",
			  cache : "false",
			  data : {
				name : name,
				fbId : fbId,
				gender : gender,
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
		//document.getElementById('status').innerHTML = '<img src="'+picture+'">';
		document.getElementById('status').innerHTML = '';
		
   });
  }
</script>
<!-- FACEBOOK FILL INFORMATION-->


<div id="status">
</div>
<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
<div id="soza"></div>
   
    </div>
  </div>
  
	<script src="assets/js/ajax_call.js"></script>
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/uploadFile.js"></script>
	
  <!-- Core  -->
  <script src="assets/global/vendor/jquery/jquery.min.js"></script>
  <script src="assets/global/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/global/vendor/animsition/animsition.min.js"></script>
  <script src="assets/global/vendor/asscroll/jquery-asScroll.min.js"></script>
  <script src="assets/global/vendor/mousewheel/jquery.mousewheel.min.js"></script>
  <script src="assets/global/vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
  <script src="assets/global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>

  <!-- Plugins -->
  <script src="assets/global/vendor/switchery/switchery.min.js"></script>
  <script src="assets/global/vendor/intro-js/intro.min.js"></script>
  <script src="assets/global/vendor/slidepanel/jquery-slidePanel.min.js"></script>

  <!-- Plugins For Tables -->
  <script src="assets/global/vendor/footable/footable.all.min.js"></script>
 <!-- Plugins For This Page -->
  <script src="assets/global/vendor/formvalidation/formValidation.min.js"></script>
  <script src="assets/global/vendor/formvalidation/framework/bootstrap.min.js"></script>
  <script src="assets/global/vendor/matchheight/jquery.matchHeight-min.js"></script>
  <script src="assets/global/vendor/jquery-wizard/jquery-wizard.min.js"></script>

  <!-- Scripts -->
  <script src="assets/global/js/core.min.js"></script>
  <script src="assets/js/site.min.js"></script>

  <script src="assets/js/sections/menu.min.js"></script>
  <script src="assets/js/sections/menubar.min.js"></script>
  <script src="assets/js/sections/sidebar.min.js"></script>

  <script src="assets/js/configs/config-tour.min.js"></script>
  <script src="assets/global/vendor/alertify-js/alertify.js"></script>

  <script src="assets/global/js/components/asscrollable.min.js"></script>
  <script src="assets/global/js/components/animsition.min.js"></script>
  <script src="assets/global/js/components/slidepanel.min.js"></script>
  <script src="assets/global/js/components/switchery.min.js"></script>


  <script src="assets/examples/js/tables/footable.min.js"></script>
  <script src="assets/global/js/components/alertify-js.min.js"></script>
  <script src="assets/examples/js/advanced/bootbox-sweetalert.min.js"></script>
  
  <script src="assets/global/js/components/jquery-wizard.min.js"></script>
  <script src="assets/global/js/components/matchheight.min.js"></script>


</body>
</html>