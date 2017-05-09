<!DOCTYPE html>
<html lang="en">
<head>
    <title>Uplus</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>
<body>

<h3>Open Contribution</h3>
            <input type="number" id="amount">
                <label for="name">Amount in Rwf</label>
            <input type="number" id="phone1" >
                <label for="phone1">From Phone</label>
            <input type="number" id="phone2">
                <label for="phone2">To Phone</label>
            </div>
            <div id="result" style="color: red;"></div></center>
            <button class="button" onclick="pay()">Send</button>

<script src="js/jquery.min.js"></script>

<script>

    function pay(){
        var amount2 = document.getElementById('amount').value;
        var phone1 = document.getElementById('phone1').value;
        var realphone1 = phone1.substring(phone1.indexOf("7"));
        var phone2 = document.getElementById('phone2').value;
        var prephone2 = phone2.substring(phone2.indexOf("7"));
        var realphone2 = '250'+prephone2;
        alert(realphone1);
        alert(realphone2);
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