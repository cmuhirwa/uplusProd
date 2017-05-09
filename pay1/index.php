<!doctype html>

<html lang="en">
  <head>
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-red.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>uplus</title>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
      <header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">uplus</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>
        </div>
      </header>
      <div class="demo-ribbon"></div>
      <main class="demo-main mdl-layout__content">
        <div class="demo-container mdl-grid">
          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
            <div class="demo-crumbs mdl-color-text--grey-500">
              By Mutual
              <?php
print_r(get_loaded_extensions());
?>
            </div>
            <h3>UPLUS TEST TRANSFER</h3>
              <p>Transfer from MTN to MTN, MTN to TIGO, TIGO to MTN and TIGO to TIGO here:</p>
			  <center/>
			  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
  				<input class="mdl-textfield__input" type="number" id="amount">
  				<label class="mdl-textfield__label" for="amount">Amount...</label>
			  </div>
			  <br/>
			  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
  				<input class="mdl-textfield__input" type="number" id="phone1">
  				<label class="mdl-textfield__label" for="phone1">From Phone:</label>
			  </div>
			  <br/>
			  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="number" id="phone2">
				<label class="mdl-textfield__label" for="phone2">To Phone:</label>
			  </div></br>
	<div id="result" style="color: red;"><button class="mdl-button mdl-button--colored mdl-button--raised mdl-js-button mdl-js-ripple-effect" onclick="pay()">Pay</button>
	<br/>
	</div></center>
          </div>
        </div>
        <footer class="demo-footer mdl-mini-footer">
          <div class="mdl-mini-footer--left-section">
            <ul class="mdl-mini-footer--link-list">
              <li><a href="#">Help</a></li>
              <li><a href="#">Privacy and Terms</a></li>
              <li><a href="#">User Agreement</a></li>
            </ul>
          </div>
        </footer>
      </main>
    </div>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<script>
function pay(){
	var amount = document.getElementById('amount').value;
	var phone1 = document.getElementById('phone1').value;
	var realphone1 = phone1.substring(phone1.indexOf("7"));
	var phone2 = document.getElementById('phone2').value;
	var prephone2 = phone2.substring(phone2.indexOf("7"));
	var realphone2 = '250'+prephone2;
	//alert(realphone1);
	//alert(realphone2);
	document.getElementById('result').innerHTML = 'Contacting MTN...';
	$.ajax({
			type : "GET",
			url : "backend.php",
			dataType : "html",
			cache : "false",
			data : {
				
				amount : amount,
				phone1 : realphone1,
				phone2 : realphone2,
			},
			success : function(html, textStatus){
			$("#result").html(html);
				
			},
			error : function(xht, textStatus, errorThrown){
				alert("Error : " + errorThrown);
			}
	});
}
</script>

  </body>
</html>
