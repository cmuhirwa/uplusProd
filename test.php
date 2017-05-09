<?php include("template/header.php");?>

 <!-- Page -->
  <div class="page animsition">
   
  <div class="page-content container-fluid">
    <div class="row">
      <div class="col-lg-9 col-sm-9">
        <div class="row">
          <div class="col-lg-4 col-sm-6">
              <!-- Widget Linearea One-->
			  <a href="ikimina">
              <div class="widget widget-shadow" id="widgetLineareaOne">
                <div class="widget-content">
                  <div class="padding-20 padding-top-10">
                    <div class="clearfix">
					
                      <div class="grey-800 pull-left padding-vertical-10">
                        <i class="icon md-accounts-alt grey-600 font-size-24 vertical-align-bottom margin-right-5">
                          
                        </i>                    SAVINGS
                      </div>
                      <span class="pull-right grey-700 font-size-30">
                        <?php
                          $sql1 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'IKIMINA' and `userPhone` = '$phone'");
                          $count_accounts = mysqli_num_rows($sql1);
                          echo $count_accounts;
                        ?>
                        </span>
                    </div>
                    <div class="margin-bottom-20 grey-500"></div>
                    <div class="ct-chart height-50"></div>
                  </div>
                </div>
              </div>
			  </a>
              <!-- End Widget Linearea One -->
          </div>
          <div class="col-lg-4 col-sm-6">
			  <a href="adminonce.php">
              <!-- Widget Linearea Two -->
              <div class="widget widget-shadow" id="widgetLineareaTwo">
                <div class="widget-content">
                  <div class="padding-20 padding-top-10">
                    <div class="clearfix">
                      <div class="grey-800 pull-left padding-vertical-10">
                        <i class="icon md-leak grey-600 font-size-24 vertical-align-bottom margin-right-5">
                          
                        </i>                    CONTRIBUTIONS
                      </div>
                      <span class="pull-right grey-700 font-size-30">
                        <?php
                          $sql1 = $db->query("SELECT * FROM `joined_ua` WHERE (groupType = 'WEDDING' or groupType = 'TIGHT') AND (`userPhone` = '$phone' AND acceptance = 'yes')");
                          $count_accounts = mysqli_num_rows($sql1);
                          echo $count_accounts;
                        ?>
                      </span>
                    </div>
                    <div class="margin-bottom-20 grey-500">
                    </div>
                    <div class="ct-chart height-50"></div>
                  </div>
                </div>
              </div>
              </a>
			  <!-- End Widget Linearea Two -->
          </div>
          <div class="col-lg-4 col-sm-6">
            <!-- Widget Linearea Three -->
			<a href="shora">
            <div class="widget widget-shadow" id="widgetLineareaThree">
              <div class="widget-content">
                <div class="padding-20 padding-top-10">
                  <div class="clearfix">
                    <div class="grey-800 pull-left padding-vertical-10">
                      <i class="icon md-balance grey-600 font-size-24 vertical-align-bottom margin-right-5">
                        
                      </i>                    INVESTMENTS
                    </div>
                    <span class="pull-right grey-700 font-size-30">
                      <?php
              					$sql1 = $db->query("SELECT * FROM `joined_ua` WHERE groupType = 'INVESTMENT' and `userPhone` = '$phone'");
              					$count_accounts = mysqli_num_rows($sql1);
              					echo $count_accounts;
              				?>
                    </span>
                  </div>
                  <div class="margin-bottom-20 grey-500"></div>
                  <div class="ct-chart height-50"></div>
                </div>
              </div>
            </div>
            <!-- End Widget Linearea Three -->
			</a>
		  </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-xs-12 masonry-item ">
          
            <!-- Widget -->
            <div class="widget widget-article widget-shadow">
              <div class="widget-left cover plyr" id="tutorials">
                <iframe class="cover-background" width="559" height="315" frameborder="0" allowfullscreen>
                  
                </iframe>
              </div>
              <div class="widget-body" style="background-color: #fff;">
                <h4 class="widget-title">How to use Uplus</h4>
                <p>UPlus is a Social contribution platform, to help you collect money 
				around the world instantly in your local currency.</p>
                 <a href="javascript:void(0)" onclick="videoinfo()" style="font-size: 16px;"><i class="icon md-play"></i>&nbsp; Intro</a> <em style="font-size: 11px;">(00:30)</em><br/>
                 <a href="javascript:void(0)" onclick="videosavings()" style="font-size: 16px;"><i class="icon md-play"></i>&nbsp; Collect Money</a> <em style="font-size: 11px;">(01:13)</em><br/>
                 <a href="javascript:void(0)" onclick="videocontribution()" style="font-size: 16px;"><i class="icon md-play"></i>&nbsp; Save Money</a> <em style="font-size: 11px;">(01:30)</em><br/>
                 
                <div class="widget-body-footer">
                  <div class="widget-actions pull-left">
                    <a href="javascript:void(0)">
                      <i class="icon md-share"></i>
                    </a>
                   
                  </div>
                  <a class="btn btn-warning pull-right" href="learn">
                    <i class="icon md-chevron-right"></i> Learn More
                  </a>
                </div>
              </div>
            </div>
            <!-- End Widget -->
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-3">
        <div class="qa-message-list" id="wallmessages">
          <div class="message-item" id="m3">
            <div class="message-inner">
              <div class="message-head clearfix">
                <div class="avatar pull-left"><a href="./index.php?qa=user&qa_1=monu"><img src="proimg/2.jpg"></a></div>
                <div class="user-detail">
                  <h5 class="handle">uPlus & MTN</h5>
                  <div class="post-meta">
                    <div class="asker-meta">
                      <span class="qa-message-what"></span>
                      <span class="qa-message-when">
                        <span class="qa-message-when-data">Oct 31</span>
                      </span>
                      <span class="qa-message-who">
                        <span class="qa-message-who-pad">:</span>
                        <span class="qa-message-who-data"><a href="./index.php?qa=user&qa_1=monu">Anounce</a></span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="qa-message-content">
               Uplus is now accepting MTN transfers, now you can recieve contribution from members with MTN mobile money accounts
              </div>
            </div>
          </div>
		</div>
      </div>
    </div>
  </div>
  
<?php include ("template/footer.php");?>
<script>
// VIDEOS TUTORIALS
function videoinfo(){
 document.getElementById('tutorials').innerHTML = '<iframe width="560" height="315" src="https://www.youtube.com/embed/_QoR_i0IIfY" frameborder="0" allowfullscreen></iframe>';
  }
function videosavings(){
	document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
 document.getElementById('tutorials').innerHTML = '<iframe width="559" height="315" src="https://www.youtube.com/embed/vj7XExwChwI" frameborder="0" allowfullscreen></iframe>';
  }
function videocontribution(){
	document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';	
 document.getElementById('tutorials').innerHTML = '<iframe src="https://player.vimeo.com/video/72700224" width="559" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
  }
function videoloans(){
	document.getElementById('invite').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
 document.getElementById('tutorials').innerHTML = '<iframe width="559" height="315" src="https://www.youtube.com/embed/8b5-iEnW70k" frameborder="0" allowfullscreen></iframe>';
 
  }
</script>


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
 <!--FACEBOOK FILL INFORMATION-->

<script>
// Pull the facebook to  be able to fill the profile
 function profileFaceBook(personalID){
	document.getElementById('group_infromation').innerHTML = '<div style="padding-left:40%;padding-bottom:40px;padding-top:40px;"><div class="loader-wrapper active"><div class="loader-layer loader-red-only"><div class="loader-circle-left"><div class="circle"></div> </div><div class="loader-circle-gap"></div><div class="loader-circle-right"><div class="circle"></div></div></div> </div></div>';
	$.ajax({
			type : "GET",
			url : "scripts/facebook.php",
			dataType : "html",
			cache : "false",
			data : {
				FbProfileID : personalID,
			},
			success : function(html, textStatus){
				$("#group_infromation").html(html);
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
 }
</script>
</body>

</html>



                