<html lang="en"><head>
	<meta charset="UTF-8">
	<title> Amz Park</title>
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


</body>
<div style="height: 100px"></div>


<div class = "formContainer">
<form action ="" method="post">
	<h1 class = "title">Employee Login</h1>
	<div id="message box"> <?php  if (isset($message)) echo $message; ?></div>
	<input type = "text" name = "username" class = "box" placeholder="Username" /><br /><br />
    <input type = "password" name = "password" class = "box" placeholder="Password" /><br/><br />
    <input name = "submit" type = "submit" value = "LOGIN "/>
    <br>

</form>
</div>


</html>

<?php
include 'database.php';
$ispost = isset($_POST['submit']);
if ($ispost) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = executeSQL("SELECT * FROM administrator1 WHERE name = '$username' AND password = '$password'");
	if ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		header("location: ../administrator/adminSystem.php");
	} else {
		echo "Cannot login! Please check your username and password";
	}
}
 ?>
