<!DOCTYPE html>
<html lang="en">
<head>
    <title>Uplus</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>
<body>

<h3>Open Contribution</h3>
            <p>( MTN->TIGO->MTN->TIGO->TIGO)</p>
        <form action="#">
            <div class="input-field">
                <input type="number" id="amount" class="validate">
                <label for="name">Amount in Rwf</label>
            </div>
            <div class="input-field">
                <input type="number" id="phone1" class="validate">
                <label for="email">From Phone</label>
            </div>
            <div class="input-field">
                <input type="number" id="phone2" class="validate">
                <label for="number">To Phone</label>
            </div>
            <div id="result" style="color: red;"></div></center>
            <button class="button" onclick="pay()">Send</button>

        </form>
<script src="js/jquery.min.js"></script>

<script>
    function pay(){
        var amount2 = document.getElementById('amount').value;
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
            url : "mobilemoney.php",
            dataType : "html",
            cache : "false",
            data : {

                amount2 : amount2,
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
<!-- Localized -->