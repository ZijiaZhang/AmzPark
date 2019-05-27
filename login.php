<?php
	include ('database.php');
	session_save_path('/home/g/***REMOVED***/sessions');
	$ppp = session_start();
	var_dump($ppp);
	print_r($_SESSION);
	#$ispost =($_SERVER["REQUEST_METHOD"] == "POST");
	$ispost = isset($_POST['submit']);
	//var_dump($_POST);
	//var_dump($ispost);
	if($ispost){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$result  = executeSQL("SELECT * FROM groups WHERE groupID = '$username' AND password = '$password'");
		if($row = OCI_Fetch_Array($result, OCI_BOTH)){
			echo "SUCCESS";
			$_SESSION['login_user'] = $username;
			print_r($_SESSION);
			header("location: ../myaccount");
		}else{
			echo 'Cannot Login Chech username AND PASSWORD';#"SELECT * FROM groups WHERE groupID = '$username' AND password = '$password'";
		}
	}
?>