<?php
//include_once '../login.php';
include_once '../session.php';
initializeSession();
#print_r($_SESSION);

	if(checkSession()){
		//header('location: ./account');
		echo "Your Session ID: ";
		var_dump(session_id());
		$name = $_SESSION['login_user'];
		echo "Your Username is $name";
	}else{
		header('location: ../login');
	}
?>

<a href="../logout.php">Log Out</a>