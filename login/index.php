<?php
	##print_r($_SESSION);
	include_once ('../login.php');
	include_once ('../session.php');
	if(checkSession()){
		header("location: ../myaccount");
	}
?>

<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Log In</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/mycss.css">
	<link rel="stylesheet" type = "text/css" href="../server_files/css/form.css">
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<?php include "../loader.php"; ?>
<body style="margin: 0px;">
	<div id = "nav-placeholder">
	
</div>
<script>
$(function(){
  $("#nav-placeholder").load("../navbar.html");
});
</script>

<div class= "nvbarSpliter"style="height: 100px"></div>


<div class = "formContainer">
<form action ="" method="post">
	<div id="messagebox" class = "center" style = "color:#f99500; text-align: center;"> <?php  if (isset($message)) echo $message; ?></div>
	<h1 class = "title">Visitor Login</h1>
	<input type = "text" name = "username" class = "box" placeholder="Username" /><br /><br />
    <input type = "password" name = "password" class = "box" placeholder="Password" /><br/><br />
    <input name = "submit" type = "submit" value = "LOGIN "/><br />
    <a pos="inform" href="../recoverAccount">Forget Password</a>
    <br>
    <a pos = "inform" href="../administrator/login.php">Employee Login</a>
</form>
</div>


</html>
