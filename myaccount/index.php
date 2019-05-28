<?php
include '../login.php';
print_r($_SESSION);
var_dump(session_id());
	if(isset($_SESSION['login_user'])){
		//header('location: ./account');
		$name = $_SESSION['login_user'];
		echo "Your Username is $name";
	}
?>