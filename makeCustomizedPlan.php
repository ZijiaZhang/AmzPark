<?php 
include "database.php";
include "session.php";
$ispost =($_SERVER["REQUEST_METHOD"] == "POST");


//include_once 'session.php';
//include_once 'database.php';
initializeSession();


if(checkSession()){
	var_dump(session_id());
	$gname = $_SESSION['login_user'];
}else{
	header('location: ../login');
}


var_dump($_POST);

if($ispost) {
	$pname = $_POST['planName'];
	$aname = $_POST['attName'];

if (array_key_exists('addAtt', $_POST)){
	if(!ifExist2($pname, $aname, 'PLANNUMBER' , 'ATTNAME', 'ofVisiting')){
		try {
			insertIntoOfVisiting($pname,$aname);
			$Success = urlencode("Attraction added successfully");
		    header('location: ./addAttToPlan/index.php?Message='.$Success);
		}catch (Exception $e){
			echo "Error. Cannot add it to the plan.";
		}
	}
	else{
		echo "This attraction is already in this plan";
	}


}
}





?>