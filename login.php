<?php
	include_once ('database.php');
	include_once ('session.php');
	#var_dump($ppp);
	#print_r($_SESSION);
	initializeSession();
	$time = $_SERVER['REQUEST_TIME'];
	$timeout = 1800;
	#$ispost =($_SERVER["REQUEST_METHOD"] == "POST");
	$ispost = isset($_POST['submit']);
	//var_dump($_POST);
	//var_dump($ispost);
	//var_dump($_GET);
	if($_GET["message"] == "signup")
		$message = "Signup Successful. Please Login";

	if($ispost){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$result  = executeSQL("SELECT * FROM groups WHERE groupID = '$username' AND password = '$password'");
		if($row = OCI_Fetch_Array($result, OCI_BOTH)){
			echo "SUCCESS";
			createSession($username);

			print_r($_SESSION);
			header("location: ../myaccount");


		}else{
			$message = 'Cannot Login, Check username AND PASSWORD';#"SELECT * FROM groups WHERE groupID = '$username' AND password = '$password'";
		}
	}
?>