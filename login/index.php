<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body style="margin: 0px;">
	<div id = "nav-placeholder">
	
</div>
<script>
$(function(){
  $("#nav-placeholder").load("../navbar.html");
});
</script>

<?php
	if(!$_COOKIE['username'])


?>




</body>
<div style="height: 100px"></div>
<form action ="" method="post">
	<label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
</form>



</html>
