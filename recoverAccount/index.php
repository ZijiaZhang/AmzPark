<html>
<head>
	<title>Recover Your Account</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	

	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel="stylesheet" href="../server_files/css/form.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
	<body style="margin: 0px;">
	<div id = "nav-placeholder">
	
</div>
<script>
$(function(){
  $("#nav-placeholder").load("../navbar.html");
});
</script>
<div class= "nvbarSpliter"style="height: 100px"></div>

	<?php 
	if(!isset($_POST["submit"])){
		if(!isset($_GET["groupnm"])){
		include "getUserName.php";
		}else{
			include "newPass.php";
		}
	}
	else if($_POST["submit"] == "confirmInfo"){
		include "getInfo.php";
	}else if($_POST["submit"] == "Infos"){
		include "resetPassword.php";
	}else if($_POST["submit"] == "newPass"){
		include "../database.php";
		$pass = md5($_POST["pass"]);
		$list1 = array(
				":bind1" => $_POST["groupnm"],
				":bind2" => $_POST["temppass"],
				":bind3" => $pass
		);
		try{
		$r = executeBoundSQL("UPDATE GROUPS SET password = :bind3 WHERE groupid = :bind1 and password = :bind2",$list1);
		header("location: ../login/?message=Successfully Resetting Password");
		}catch (Exception $e){
			header("location: ../login/?message=Error Resetting Password");
		}



	}
	?>
</body>
</html>