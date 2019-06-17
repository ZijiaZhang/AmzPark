<?php
	function initializeSession(){
	session_save_path('/home/l/lyr98/sessions');
	session_start();
	}

	function createSession($username){
		$time = $_SERVER['REQUEST_TIME'];
		$_SESSION['login_user'] = $username;
		$_SESSION['lastActivity'] = $time;
	}

	function checkSession(){
		$time = $_SERVER['REQUEST_TIME'];
		$timeout = 1800;
		if(isset($_SESSION['login_user'])&& isset($_SESSION['lastActivity']) && $time - $_SESSION['lastActivity'] < $timeout){
		$_SESSION['lastActivity'] = $time;
		return true;
		}else{
			session_destroy();
			return false;
		}
	}

	function destroySession(){
		session_destroy();
	}
?>
