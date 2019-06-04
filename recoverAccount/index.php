<!DOCTYPE html>
<html>
<head>
	<title>Recover Your Account</title>
</head>
<body>
	<?php 
	if(!isset($_POST["submit"])){
		include "getUserName.php";
	}
	else if($_POST["submit"] == "confirmInfo"){
		include "getInfo.php";
	}else if($_POST["submit"] == "success"){
		$command = escapeshellcmd('./RecoverEmail.py');
		$output = shell_exec($command);
	}
	?>
</body>
</html>