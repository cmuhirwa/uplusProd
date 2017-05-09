<?php if(isset($_GET['csd'])){
?>

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

 <button onclick="senddata()">SEND</button> 
</div>
<form>
    <input type=button name=print value="Print" onClick="window.print()">
</form>
<script src="assets/js/jquery.js"></script>
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
				attachments     : attachments
				
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
    

<?php }
?>	