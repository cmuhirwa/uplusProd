
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
	<title>Admin</title>
	<script src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
	<script src="assets/global/vendor/jquery/jquery.min.js"></script>
</head>
<body >
<div id="resultdiv"></div>
<button class="btn btn-success"></button>
<i class="icon ">
<input type="hidden" id="hdnParentListId" value='0'/>
<script>
$(document).ready(function(){
	selectList();
})
function selectList(){
	$.ajax({
		url:"dbconnect/conx.php?query=list",
		datatype: "json",
		data:"parentlistid="+hdnParentListId.value,
		success:function(response){
			$("#resultdiv").html(response);
		}
	})
}
</script>
</body>
</html>

