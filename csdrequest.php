<?php include('template/header.php')?>
<link href="croppic/assets/css/main.css" rel="stylesheet">
	<link href="croppic/assets/css/croppic.css" rel="stylesheet">

	<div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">Request For a CSD account</h1>
      <div class="page-header-actions">
        <form>
          <div class="input-search input-search-dark">
            <i class="input-search-icon md-search" aria-hidden="true"></i>
            <input type="text" class="form-control" name="" placeholder="Search...">
          </div>
        </form>
      </div>
    </div>
    <div class="page-content">
      
	<div id="results">
 title			: <select id="title" required>
						<option value=""></option>
						<option value="Mr">Mr</option>
						<option value="Mrs">Mrs</option>
						<option value="Dr">Dr</option>
						<option value="Pr">Pr</option>
						<option value="Hn">Hn</option>
					</select>
 <br>
					<input type="hidden" id="userId" value="<?php echo $thisid;?>"><br>
 surname		: <input type="text" id="surname"><br>
 otherNames		: <input type="text" id="otherNames"><br>
 dob			: <input type="date" id="dob"><br>
 gender			:<select id="gender">
						<option value=""></option>
						<option value="Mr">Male</option>
						<option value="Mrs">Female</option>
					</select><br>
 nidPassport	: <input type="text" id="nidPassport"><br>
 nationality	: <input type="text" id="nationality"><br>
 postalLine1	: <input type="text" id="postalLine1"><br>
 postalLine2	: <input type="text" id="postalLine2"><br>
 phyisicalLine3	: <input type="text" id="phyisicalLine3"><br>
 postCode		: <input type="text" id="postCode"><br>
 taxCode		: <input type="text" id="taxCode"><br>
 city			: <input type="text" id="city"><br>
 country		: <input type="text" id="country"><br>
 residentIn		: <input type="text" id="residentIn"><br>
 telephone		: <input type="text" id="telephone"><br>
 fax			: <input type="text" id="fax"><br>
 e-mail         : <input type="text" id="email"><br>
 bankName       : <input type="text" id="bankName"><br>
 branch         : <input type="text" id="branch"><br>
 accountNumber  : <input type="text" id="accountNumber"><br>
 attachments    : <input type="file" id="attachments"><br>

Profile Picture:<div id="cropContainerModal" style="height:300px; width:300px;"></div>

 <button onclick="senddata()">SEND</button> 
</div>
    <button onClick="window.print()">Print</button>
<script src="assets/js/jquery.js"></script>

<?php include('template/footer.php')?>

<script>
function senddata(){
	//alert('am here!');
	var title =$("#title").val();	
	if (title == null || title == "") {
        alert("title must be filled out");
        return false;
    }
    var surname		    =$("#surname").val();
    var otherNames		=$("#otherNames").val();
    var dob			    =$("#dob").val();
    var gender			=$("#gender").val();
    var nidPassport	    =$("#nidPassport").val();
    var nationality	    =$("#nationality").val();
    var postalLine1	    =$("#postalLine1").val();
    var postalLine2	    =$("#postalLine2").val();
    var phyisicalLine3	=$("#phyisicalLine3").val();
    var postCode		=$("#postCode").val();
    var taxCode		    =$("#taxCode").val();
    var city			=$("#city").val();
    var country		    =$("#country").val();
    var residentIn		=$("#residentIn").val();
    var telephone		=$("#telephone").val();
    var fax			    =$("#fax").val();
    var email          =$("#email").val();
    var bankName        =$("#bankName").val();
    var branch          =$("#branch").val();
    var accountNumber   =$("#accountNumber").val();
    var attachments     =$("#attachments").val();
    var userId     		=$("#userId").val();
	
	$.ajax({
			  type : "GET",
			  url : "sendbnr.php",
			  dataType : "html",
			  cache : "false",
			  data : {
				
				title			: title,
				surname		    : surname,
				otherNames		: otherNames,
				dob			    : dob,
				gender			: gender,
				nidPassport	    : nidPassport,
				nationality	    : nationality,
				postalLine1	    : postalLine1,
				postalLine2	    : postalLine2,
				phyisicalLine3	: phyisicalLine3,
				postCode		: postCode,
				taxCode		    : taxCode,
				city			: city,
				country		    : country,
				residentIn		: residentIn,
				telephone		: telephone,
				fax			    : fax,
				email          	: email,
				bankName        : bankName,
				branch          : branch,
				accountNumber   : accountNumber,
				attachments     : attachments,
				userId     : userId
				
			  },
			  success : function(html, textStatus){
				$("#results").html(html);
			  },
			  error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			  }
		  });
	}
</script>
    
	
	
	<script src="croppic/assets/js/bootstrap.min.js"></script>
	<script src="croppic/assets/js/jquery.mousewheel.min.js"></script>
   	<script src="croppic.min.js"></script>
    <script src="croppic/assets/js/main.js"></script>
    <script>
		var croppicContainerModalOptions = {
				uploadUrl:'img_save_to_file.php?investorId=<?php echo $thisid;?>',
				cropUrl:'img_crop_to_file.php?investorId=<?php echo $thisid;?>',
				modal:true,
				imgEyecandyOpacity:0.4,
				loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
				onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
				onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
				onImgDrag: function(){ console.log('onImgDrag') },
				onImgZoom: function(){ console.log('onImgZoom') },
				onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
				onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
				onReset:function(){ console.log('onReset') },
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContainerModal = new Croppic('cropContainerModal', croppicContainerModalOptions);
		
	</script>
	