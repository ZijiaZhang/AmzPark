<?php 
include "database.php";
$ispost =($_SERVER["REQUEST_METHOD"] == "POST");


include_once 'session.php';
include_once 'database.php';
initializeSession();


if(checkSession()){
		//header('location: ./account');
	//echo "Your Session ID: ";
	var_dump(session_id());
	$name = $_SESSION['login_user'];
}else{
	header('location: ../login');
}


if($ispost) {
      // username and password sent from form 
	var_dump($_POST);
	#print_r($_POST);
	//$groupID = $_POST['groupID'];
	$pname = $_POST['planName'];
	#echo $name;
	

    function ifExist2($gid, $pn, $keyname1, $keyname2, $database){
		$list1 = array (
			//":bind1" => $gid,
			":bind1" => $gid,
			//":bind3" => $pn,
			":bind2" => $pn);

		$command = "SELECT * FROM $database WHERE $keyname1 = :bind1 AND $keyname2 = :bind2";
		try{
			$stid = executeBoundSQL($command, $list1);
		}catch(Exception $e){
			echo $e.getMessage();
			return false;
		}
		return ($t = oci_fetch($stid));

	}
	
	if(!ifExist2($name, $pname, 'GROUPID', 'PLANNUMBER' , 'MadeBy')){
		try {
			insertIntoMadeBy($name, $pname);
			header('location: ./myaccount');
		}catch (Exception $e){
			echo "Cannot Create Plan";
		}
	}else{
		echo "There is already a plan with the same name in your plans. Please use a new name.";
	}
}


?>